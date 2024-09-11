#!/usr/bin/env bash

# Cargar variables del archivo .env
export $(grep -v '^#' /var/www/html/.env | xargs)

echo "Running composer"
composer global require hirak/prestissimo
composer install --no-dev --working-dir=/var/www/html

# Check if GENERATE_KEY is set and true
if [ "$GENERATE_KEY" = true ]; then
    echo "Generating application key..."
    php /var/www/html/artisan key:generate
fi

echo "Caching config..."
php /var/www/html/artisan config:cache

echo "Caching routes..."
php /var/www/html/artisan route:cache
