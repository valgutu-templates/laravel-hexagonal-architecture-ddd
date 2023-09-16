image-name     :=laravel-ddd

# docker-target (See Dockerfile) local, dev, staging, prod
docker-target  :=local
app-dir		   :=/var/www/framework

uid                   :=$(shell id -u)
gid                   :=$(shell id -g)
# set uid/gid to local host for dev, 1001 for staging/prod
ifeq ($(target),prod)
	BUILD_USER_ID  :=1001
	BUILD_GROUP_ID :=1001
else
	BUILD_USER_ID  :=$(uid)
	BUILD_GROUP_ID :=$(gid)
endif

# DB config for local app-mysql instance
define ENV_DB_LARAVEL_DDD_MYSQL
-e MYSQL_DATABASE=database \
-e MYSQL_ROOT_PASSWORD=user \
-e MYSQL_USER=user \
-e MYSQL_PASSWORD=user
endef

up:
	make build
	make run
	make nginx-run
	make mysql-run
	make redis-run
	make ps
	@echo "localhost:8080"

down: ## same as vagrant down
	make stop||true
	make nginx-stop||true
	make mysql-stop||true
	make redis-stop||true

restart:
	make down
	make up

build: ## (*) Build docker image, use target=[dev|local]
	DOCKER_BUILDKIT=1 docker build \
		--build-arg USER_ID=$(BUILD_USER_ID) --build-arg GROUP_ID=$(BUILD_GROUP_ID) \
		--target $(docker-target) \
		--tag="$(image-name):$(docker-target)" \
		-f - . < etc/docker/Dockerfile

run: ## (*) Run the app php-fpm service
ifeq ("$(wildcard vendor)", "")
	docker run -it --rm -d --init \
		-u $(uid):$(gid) \
		--name "$(image-name)" \
		--network "$(image-name)-network" \
		-v "$(PWD):/var/www" \
        -v "$(PWD)/var/log/php:/var/log/php" \
		"$(image-name):$(docker-target)" \
		/bin/bash
	docker exec -it "$(image-name)" /bin/bash -c "composer install --ignore-platform-reqs"
	make stop
	make run
else
	docker run -it --rm -d \
		-u "$(uid):$(gid)" \
		--name "$(image-name)" \
		--network "$(image-name)-network" \
		-e XDEBUG_CONFIG="remote_host=$(local-ip)" \
		-e PHP_IDE_CONFIG="serverName=$(image-name)" \
		-v "$(PWD):/var/www" \
		-v "$(PWD)/var/log/php:/var/log/php" \
		"$(image-name):$(docker-target)" \
		php-fpm -F
		make supervisor-start
endif

stop: ## Stop the server
	docker stop "$(image-name)"

nginx-run: ## Run a nginx container linked to laravel ddd
	docker run -it --rm -d \
		--name "$(image-name)-nginx" \
		--network "$(image-name)-network" \
		--link $(image-name) \
		-p 8080:80 \
		-p 8083:443 \
		-e PHP_IDE_CONFIG="serverName=$(image-name)" \
		-v "$(PWD)/etc/docker/nginx/nginx.conf:/etc/nginx/nginx.conf" \
		-v "$(PWD)/etc/docker/nginx/conf:/etc/nginx/conf" \
		-v "$(PWD)/etc/docker/nginx/ssl:/etc/nginx/ssl" \
		-v "$(PWD)/etc/docker/nginx/conf.d/default.conf:/etc/nginx/conf.d/default.conf" \
		-v "$(PWD):/var/www" \
		-v "$(PWD)/var/log/nginx:/var/log/nginx/" \
		 nginx:1.17.9-alpine

nginx-stop: ## Stop the server
	docker stop "$(image-name)-nginx"

mysql-run: ## Run mysql 8 for laravel (local: mysql -u user --password=user -h 127.0.0.1 -P 3336)
	docker run --rm \
		--name $(image-name)-mysql \
		--network "$(image-name)-network" \
		--hostname=$(image-name)-mysql \
		-v "$(PWD)/etc/docker/mysql/my.cnf":/etc/mysql/my.cnf \
		-v "$(PWD)/etc/docker/mysql/data":/var/lib/mysql \
		-v "$(PWD)/etc/docker/mysql/sql":/docker-entrypoint-initdb.d/ \
		$(ENV_DB_LARAVEL_DDD_MYSQL) \
		-p 3336:3306 \
		-d mysql:8.0

mysql-stop: ## stop mysql 8 for server
	docker stop $(image-name)-mysql

redis-run: ## Run redis for server (local connect: 127.0.01:6479)
	docker run --rm \
		--name $(image-name)-redis \
		--network "$(image-name)-network" \
		--hostname=$(image-name)-redis \
		-p 6479:6379 \
		-d redis

redis-stop: ## Stop redis for server
	docker stop $(image-name)-redis

ps: ## alias for docker ps
	docker ps --format 'table {{printf "%.20s" .Names}}\t{{.Image}}\t{{.Command}}\t{{.Ports}}\t{{printf "%.15s" .Status}}'

create-network: ## create a network bridge for nginx <-> php-fpm comms
	docker network inspect $(image-name)-network >/dev/null 2>&1 || \
		docker network create --driver bridge $(image-name)-network

logs: ## Displays app logs
ifdef type
	tail -n 60 -F $(PWD)/var/log/php/$(type)*
else
	tail -n 60 -F $(PWD)/var/log/php/error.php-fpm.log $(PWD)/var/log/php/laravel-ddd.log | awk '/INFO/ {print "\033[32m" $$0 "\033[39m"} /DEBUG/ {print "\033[34m" $$0 "\033[39m"} /ERROR/{print "\033[31m" $$0 "\033[39m"} !/INFO|DEBUG|ERROR/{print "\033[35m" $$0 "\033[39m"}'
endif

php-artisan: ## run a command cmd="landers:sync -v" for egp
ifdef cmd
	docker exec $(image-name) $(app-dir)/artisan $(cmd)
else
	@echo "Please specify a cmd to run, e.g make console cmd='landers:sync -v'"
endif

php-artisan-optimize: ## run a command cmd="landers:sync -v" for egp
	make php-artisan cmd="optimize"

migrate-create:
ifdef name
	make php-artisan cmd="make:migration ${name}"
else
	@echo "Please specify migration name to run, e.g make create-migration name='flights'"
endif

migrate-up: ## The Up command runs all of the available migrations on the laravel (mysql) environment
	make php-artisan cmd="migrate"

migrate-down: ## The Down command rollbacks a single migration on the laravel (mysql) environment
	make php-artisan cmd="migrate:rollback"

## Implement command to create action (Actions, CommandBus, etc.)
make create-action:
	@echo "Implement command"

## Supervisor - Queue Worker commands
supervisor-start: ## Starts the supervisor process in the container
	docker exec -it -u 0 "$(image-name)" /usr/bin/supervisord

laravel-worker-log:
	docker exec -it -u 0 "$(image-name)" tail /var/log/supervisor/supervisor.log

laravel-worker-status: ## View the status of the supervisor queue-worker program
	docker exec -it -u 0 "$(image-name)" supervisorctl status laravel-worker:*

laravel-worker-start: ## Uses supervisorctl to start the queue-worker program
	docker exec -it -u 0 "$(image-name)" supervisorctl start laravel-worker:*

laravel-worker-stop: ## Uses supervisorctl to stop the queue-worker program
	docker exec -it -u 0 "$(image-name)" supervisorctl stop laravel-worker:*

laravel-worker-attributes: ## Gets the current attributes of the queue-worker program
	make console cmd="queue:worker state -Q main_queue"
