FROM php:8.2-apache

RUN apt-get update && \
    apt-get install -y libpq-dev && \
    docker-php-ext-install pdo pgsql pdo_pgsql

RUN a2enmod rewrite

# Tambahkan ServerName
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

WORKDIR /var/www/html

COPY ./src/ /var/www/html/

CMD ["apache2-foreground"]
