# Gunakan PHP + Apache resmi
FROM php:8.2-apache

# Install ekstensi PostgreSQL
RUN apt-get update && \
    apt-get install -y libpq-dev && \
    docker-php-ext-install pdo_pgsql pgsql

# Aktifkan mod_rewrite
RUN a2enmod rewrite

# Atur ServerName untuk suppress warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Copy project ke container
WORKDIR /var/www/html
COPY ./src/ /var/www/html/

# Buka port 80
EXPOSE 80
