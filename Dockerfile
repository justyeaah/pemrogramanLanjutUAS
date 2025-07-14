FROM php:8.2-apache

RUN apt-get update && \
    apt-get install -y libpq-dev && \
    docker-php-ext-install pdo pdo_pgsql pgsql

RUN a2enmod rewrite

# Ganti Apache ke port 8080
RUN sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf && \
    sed -i 's/:80>/:8080>/' /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html
COPY ./src/ /var/www/html

EXPOSE 8080
