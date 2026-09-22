#!/bin/bash
set -e

echo "==> Generating app key..."
php artisan key:generate --force

echo "==> Running package discovery..."
php artisan package:discover --ansi

echo "==> Clearing config cache..."
php artisan config:clear
php artisan config:cache

echo "==> Setting up storage link..."
php artisan storage:link || true

echo "==> Running migrations and seeders..."
php artisan migrate --force --seed

echo "==> Caching routes and views..."
php artisan route:cache
php artisan view:cache

echo "==> Starting Apache..."
exec "$@"
