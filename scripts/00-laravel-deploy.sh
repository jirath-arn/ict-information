#!/usr/bin/env bash

echo "Running composer"
composer install --no-dev --working-dir=/var/www/html

echo "Clear config..."
php artisan config:clear

echo "Clear cache..."
php artisan cache:clear

echo "Clear event..."
php artisan event:clear

echo "Clear route..."
php artisan route:clear

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Running migrations..."
php artisan migrate --force