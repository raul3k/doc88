#!/usr/bin/env bash

pushd /var/www
    composer install
    php artisan clear-compiled
    php artisan migrate --seed
popd

mkdir -p /var/www/storage/app/pastel
cp /var/www/public/pastel_default.jpg /var/www/storage/app/pastel/pastel_default.jpg

/start.sh
