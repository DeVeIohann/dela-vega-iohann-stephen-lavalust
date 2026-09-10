FROM php:8.2-apache

# Install PDO MySQL driver required by LavaLust
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache URL rewrite module for LavaLust routing
RUN a2enmod rewrite

# Copy project files into web root
COPY . /var/www/html/

WORKDIR /var/www/html/

ENV PORT=10000
EXPOSE 10000

CMD sed -i "s/Listen 80/Listen ${PORT}/g" /etc/apache2/ports.conf 2>/dev/null || true; \
    if [ -f /etc/apache2/sites-available/000-default.conf ]; then \
      sed -i "s/:80/:${PORT}/g" /etc/apache2/sites-available/000-default.conf 2>/dev/null || true; \
    fi; \
    apache2-foreground