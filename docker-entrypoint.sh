#!/bin/bash
set -e

# Set permissive umask so any files created during setup are writable by www-data
umask 0000

echo "==> Starting Tutorly container initialization..."

# 1. Ensure /var/www/html/.env exists
# In Render, secret files are mounted under /etc/secrets/.env if added as Secret File
if [ -f /etc/secrets/.env ]; then
    echo "==> Found secret file at /etc/secrets/.env, copying to /var/www/html/.env"
    cp /etc/secrets/.env /var/www/html/.env
elif [ ! -f /var/www/html/.env ]; then
    echo "==> Creating empty /var/www/html/.env..."
    touch /var/www/html/.env
fi

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

# 3. Dynamic Apache port binding and configuration for Render
if [ -n "$PORT" ]; then
    echo "==> Configuring Apache to listen on port $PORT..."
    sed -i "s/80/$PORT/g" /etc/apache2/ports.conf /etc/apache2/sites-available/*.conf
fi

# Ensure Apache reads .htaccess for URL rewriting (fixes /login and internal routes)
sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf 2>/dev/null || true

# 4. Storage directories & link
echo "==> Ensuring storage directory structure..."
mkdir -p /var/www/html/storage/logs \
    /var/www/html/storage/framework/cache/data \
    /var/www/html/storage/framework/sessions \
    /var/www/html/storage/framework/views \
    /var/www/html/storage/app/public \
    /var/www/html/bootstrap/cache

touch /var/www/html/storage/logs/laravel.log

php artisan storage:link || true

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

# 8. Set final ownership and full read/write permissions for Apache (www-data)
echo "==> Setting final permissions for Apache (www-data)..."
chown -R www-data:www-data /var/www/html/public /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/.env 2>/dev/null || true
chmod -R 755 /var/www/html/public 2>/dev/null || true
chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache 2>/dev/null || true
chmod 666 /var/www/html/storage/logs/laravel.log 2>/dev/null || true

echo "==> Initialization complete. Starting Apache web server..."
exec "$@"
