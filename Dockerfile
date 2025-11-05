FROM php:8.2-apache



# Install dependencies

RUN apt-get update && apt-get install -y \

    git curl zip unzip libpq-dev libonig-dev libzip-dev sqlite3 libsqlite3-dev \

    && docker-php-ext-install pdo pdo_mysql pdo_sqlite mbstring zip exif pcntl bcmath



# Enable Apache mod_rewrite (important for Laravel routes)

RUN a2enmod rewrite



# Set working directory

WORKDIR /var/www/html



# Copy project files

COPY . /var/www/html



# Install Composer

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer



# Install PHP dependencies

RUN composer install --no-dev --optimize-autoloader



# Expose port 8080 (Render expects this)

EXPOSE 8080



# Start Laravel server

CMD php artisan serve --host=0.0.0.0 --port=8080

