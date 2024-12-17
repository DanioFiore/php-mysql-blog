FROM php:8.0-apache

# Install PDO MySQL extension
RUN docker-php-ext-install pdo pdo_mysql

# Enable mod_rewrite
RUN a2enmod rewrite

# Copy custom Apache configuration
COPY apache.conf /etc/apache2/conf-available/servername.conf