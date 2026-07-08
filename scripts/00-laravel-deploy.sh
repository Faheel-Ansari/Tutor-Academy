#!/usr/bin/env bash

echo "Running post-deploy tasks..."

# Copy CA certificate from Render secrets to webroot to ensure PHP can read it
if [ -f /etc/secrets/ca.pem ]; then
    echo "Copying CA certificate to webroot..."
    cp /etc/secrets/ca.pem /var/www/html/ca.pem
    chmod 644 /var/www/html/ca.pem
else
    echo "Warning: CA certificate not found in /etc/secrets/ca.pem"
fi

# Run package discovery
php artisan package:discover --ansi

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Caching views..."
php artisan view:cache

echo "Running migrations..."
php artisan migrate --force