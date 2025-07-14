# Gunakan image resmi PHP + Apache
FROM php:8.2-apache

# Install ekstensi PostgreSQL
RUN apt-get update && \
    apt-get install -y libpq-dev && \
    docker-php-ext-install pdo pdo_pgsql pgsql

# Aktifkan mod_rewrite Apache jika perlu
RUN a2enmod rewrite

# Atur ServerName untuk menghindari warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Copy source code ke folder web server
WORKDIR /var/www/html
COPY ./src/ /var/www/html

# Atur permission (optional, jika perlu)
RUN chown -R www-data:www-data /var/www/html
