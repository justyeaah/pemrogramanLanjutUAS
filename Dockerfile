# Base image
FROM php:8.2-apache

# Install PostgreSQL extension & unzip (untuk Composer)
RUN apt-get update && \
    apt-get install -y libpq-dev unzip && \
    docker-php-ext-install pdo pdo_pgsql pgsql

# Enable mod_rewrite
RUN a2enmod rewrite

# Tambah Composer dari image resmi
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Pindah ke root project
WORKDIR /var/www/html

# Copy SEMUA isi project ke dalam container
COPY . .

# Kalau vendor TIDAK di-copy, jalankan ini:
# RUN composer install

# Port expose
EXPOSE 80
