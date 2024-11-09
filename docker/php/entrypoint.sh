#!/bin/sh

if [ ! -d vendor ]; then
    composer install
fi

if [ ! -d public/storage ]; then
    php artisan storage:link
fi

php artisan key:generate

php artisan migrate --seed

exec "$@"
