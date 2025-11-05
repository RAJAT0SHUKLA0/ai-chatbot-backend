#!/bin/bash
set -e

# Wait for database to be ready (if using external database)
# echo "Waiting for database..."
# while ! php artisan db:monitor > /dev/null 2>&1; do
#   sleep 1
# done

# Generate APP_KEY if not set
if [ -z "$APP_KEY" ]; then
    echo "Generating application key..."
    php artisan key:generate --force
fi

# Run migrations
echo "Running migrations..."
php artisan migrate --force || true

# Clear and cache configuration
echo "Optimizing application..."
php artisan config:clear || true
php artisan config:cache || true
php artisan route:clear || true
php artisan route:cache || true
php artisan view:clear || true
php artisan view:cache || true

# Start the server
echo "Starting Laravel server on port ${PORT:-8000}..."
exec php artisan serve --host=0.0.0.0 --port=$PORT

