# Gunakan image resmi PHP dengan Apache
FROM php:8.2-apache

# Install ekstensi PostgreSQL untuk PHP
RUN docker-php-ext-install pgsql pdo pdo_pgsql

# Copy file project ke direktori Apache
COPY ./src/ /var/www/html/

# Berikan hak akses
RUN chown -R www-data:www-data /var/www/html

# Aktifkan mod_rewrite (opsional)
RUN a2enmod rewrite
