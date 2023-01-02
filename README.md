# Laravel DDD - Hexagonal Architecture

## Description:
  - Hexagonal Architecture folder structure for REST API
  - Docker
  - Makefile
  - PHP 8.0
 
## Set up
1. Clone directory
```
git clone git@github.com:valgutu-templates/laravel-hexagonal-architecture-ddd.git
```
2. Create `.env` file from `.env.example`
3. Set up DB credentials in `Makefile` and `.env`
3. Generate key
```
make php-artisan cmd="key:generate"
```
4. Disable route caching
```
make php-artisan cmd="route:clear"
```
5. Rename app in `.env`, `Makefile`, `default.conf`, `Dockerfile`
6. Run local server
```
make up
```
7. The server should be running on `localhost:8080`
8. Stop local server
```
make down
```
