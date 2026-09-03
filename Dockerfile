FROM php:8.2-apache

# Install PDO MySQL driver required by LavaLust
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache URL rewrite module for LavaLust routing
RUN a2enmod rewrite

# Copy project files into web root
COPY . /var/www/html/

WORKDIR /var/www/html/

EXPOSE 80