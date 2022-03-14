Run:

docker-compose up -d --build

docker-compose exec php-apache /bin/bash

composer install

chown -R www-data:www-data .

php artisan migrate:fresh

php artisan db:seed

Login Admin:

username:admin
password:admin

Login User:

email:<any_user_email>
password:password


