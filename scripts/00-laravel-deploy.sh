#!/usr/bin/env bash

echo "Running post-deploy tasks..."

# Run package discovery now that live environment variables are active
php artisan package:discover --ansi

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Caching views..."
php artisan view:cache

echo "Running migrations..."
php artisan migrate --force