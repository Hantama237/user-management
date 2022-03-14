Run:

docker-compose up -d --build

docker-compose exec php-apache /bin/bash

composer install

chown -R www-data:www-data "project foldername"

php artisan migrate:fresh

php artisan db:seed