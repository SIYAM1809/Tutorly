#!/usr/bin/env bash
# Render build script for Tutorly (Laravel 11)
set -e

echo "==> Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

echo "==> Installing Node dependencies & building assets..."
npm ci
npm run build

echo "==> Setting up storage link..."
php artisan storage:link || true

echo "==> Generating app key if not set..."
php artisan key:generate --force

echo "==> Clearing & caching config..."
php artisan config:clear
php artisan config:cache

echo "==> Running database migrations & seeders..."
php artisan migrate --force --seed

echo "==> Caching routes & views..."
php artisan route:cache
php artisan view:cache

echo "==> Build complete!"
