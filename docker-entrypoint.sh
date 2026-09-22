#!/bin/bash
set -e

echo "==> Starting Tutorly container initialization..."

# 1. Ensure /var/www/html/.env exists
# In Render, secret files are mounted under /etc/secrets/.env if added as Secret File
if [ -f /etc/secrets/.env ]; then
    echo "==> Found secret file at /etc/secrets/.env, copying to /var/www/html/.env"
    cp /etc/secrets/.env /var/www/html/.env
elif [ ! -f /var/www/html/.env ]; then
    if [ -f /var/www/html/.env.example ]; then
        echo "==> Creating /var/www/html/.env from .env.example..."
        cp /var/www/html/.env.example /var/www/html/.env
    else
        echo "==> Creating empty /var/www/html/.env..."
        touch /var/www/html/.env
    fi
fi

# Ensure permissions on .env
chown www-data:www-data /var/www/html/.env 2>/dev/null || true
chmod 640 /var/www/html/.env 2>/dev/null || true

# 2. Check APP_KEY
# If APP_KEY is provided via container environment variable (Render dashboard), use it
if [ -n "$APP_KEY" ]; then
    echo "==> APP_KEY provided via environment variable."
elif grep -q "^APP_KEY=base64:" /var/www/html/.env 2>/dev/null; then
    echo "==> APP_KEY already set in .env."
else
    echo "==> Generating app key into .env..."
    php artisan key:generate --force || true
fi

# 3. Dynamic Apache port binding for Render (Render exposes dynamic $PORT, usually 10000)
if [ -n "$PORT" ]; then
    echo "==> Configuring Apache to listen on port $PORT..."
    sed -i "s/80/$PORT/g" /etc/apache2/ports.conf /etc/apache2/sites-available/*.conf
fi

# 4. Ensure storage directories and permissions
echo "==> Setting up storage link and permissions..."
php artisan storage:link || true
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache || true
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache || true

# 5. Clear and cache configuration
echo "==> Clearing and caching Laravel configuration..."
php artisan config:clear
php artisan config:cache || true

echo "==> Discovering packages..."
php artisan package:discover --ansi || true

# 6. Run database migrations & seeders (non-blocking if database takes time to connect)
echo "==> Running database migrations and seeders..."
php artisan migrate --force --seed || {
    echo "==> [NOTICE] Migrations did not complete. Check DB connection settings."
}

# 7. Cache routes and views for production performance
echo "==> Caching routes and views..."
php artisan route:cache || true
php artisan view:cache || true

echo "==> Initialization complete. Starting Apache web server..."
exec "$@"
