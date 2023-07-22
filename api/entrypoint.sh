#!/bin/sh
php artisan cache:clear
php artisan key:generate
# docker exec -it backend bash
php artisan migrate
php artisan db:seed
php artisan serve --host=0.0.0.0

