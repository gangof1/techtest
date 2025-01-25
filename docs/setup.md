[⬅️ Back to home](../README.md)

## Installation Setup 
- Create a folder and, from within it, clone this repo from github
```
git clone https://github.com/gangof1/techtest.git ./
```
- Copy .env.example file in the root of the project to .env file
```
cp .env.example .env
```
- install the application's dependencies executing the following comman <a href="https://laravel.com/docs/11.x/sail#installing-composer-dependencies-for-existing-projects">Official Larevel Hints</a>
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php84-composer:latest \
    composer install --ignore-platform-reqs
```
- Start all of the Docker containers (in background mode)
```
./vendor/bin/sail up -d
```
- Generate App Key
```
./vendor/bin/sail php artisan key:generate
```
- Run application's database migrations and seed products table
```
./vendor/bin/sail php artisan migrate --seed
```
- This will:
* Run all database migrations to set up the necessary tables.
* Seed tables with some initial data.

- Apply Meilisearch configured index settings 
```
sail php artisan scout:sync-index-settings
```
#### Hints:
* 500 orders will have been created, each order with 1 or 2 products assigned with a fixed quantity: 1. 
  * for testing purposes orders will be dated between '`2025-01-01`', '`2025-03-31`' and each one will have '`Order ....`' as name and '`Order description ...`' as descritpion
* 100 Products will have been created too, each with stock set to 500. 
* Consider starting creating a new order or pick an order having #id between 1-500 to test any other API call that require existing order data.
