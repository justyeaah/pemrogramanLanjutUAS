# Gunakan image PHP + Apache resmi
FROM php:8.2-apache

# Install ekstensi PostgreSQL PDO
RUN apt-get update && \
    apt-get install -y libpq-dev && \
    docker-php-ext-install pdo pdo_pgsql pgsql

# Aktifkan mod_rewrite kalau butuh .htaccess
RUN a2enmod rewrite

# Ganti Apache listen port ke 8080 (Zeabur pakai 8080)
RUN sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf && \
    sed -i 's/:80>/:8080>/' /etc/apache2/sites-available/000-default.conf

# Atur direktori kerja Apache (root web)
WORKDIR /var/www/html

# Copy source code
COPY ./src/ /var/www/html

# Copy folder vendor agar autoload.php tersedia
COPY ./vendor/ /var/www/html/vendor/

# Expose port 8080 (wajib cocok dengan Zeabur Container Port)
EXPOSE 8080
