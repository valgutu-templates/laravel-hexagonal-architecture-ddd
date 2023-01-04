# Laravel DDD - Hexagonal Architecture
Implementing Domain Driven Design and Hexagonal Architecture example API using Laravel.

## Description:
  - Docker
  - Makefile
  - PHP 8.0
  - Laravel
 
## Installation
### Requirements
- [Install Docker](https://www.docker.com/get-started/)

### Environment
- Clone this project: git clone git@github.com:valgutu-templates/laravel-hexagonal-architecture-ddd.git
- Create `.env` file from `.env.example`
- Set up DB credentials in `Makefile` and `.env`
- Generate key
```
make php-artisan cmd="key:generate"
```
- Disable route caching for dev/local environment
```
make php-artisan cmd="route:clear"
```
- Rename app in `.env`, `Makefile`, `default.conf`, `Dockerfile`
- Install all the dependencies and bring up the project with Docker executing:
```
make up
```
- The server should be running on `localhost:8080`
- Stop local server
```
make down
```

## Project structure and explanation
### Root Folders
**src**
`src` is for "Source". Here we put all our code base being as independent as possible of any implementation (except is there is in `infrastructure` subfolder).

## Documentation
### Run artisan commands
```
make create-migration name="ExampleMigrationName"
```

### Migrations
Create migrations
```
make php-artisan cmd="key:generate"
```

Run migrations
```
make migrate-up
```

Rollback migrations
```
migrate-down
```

## References
- [Hexagonal Architecture with Laravel](https://fideloper.com/hexagonal-architecture)
