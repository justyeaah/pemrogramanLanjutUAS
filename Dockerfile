FROM php:8.2-apache

RUN apt-get update && \
    apt-get install -y libpq-dev unzip && \
    docker-php-ext-install pdo pdo_pgsql pgsql

RUN a2enmod rewrite

# Copy Composer dari image Composer resmi
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Pindah ke /var/www/html
WORKDIR /var/www/html

# Copy semua ke /var/www/html
COPY . .

# Pindah ke folder src untuk install vendor-nya
WORKDIR /var/www/html

RUN composer install

EXPOSE 80
