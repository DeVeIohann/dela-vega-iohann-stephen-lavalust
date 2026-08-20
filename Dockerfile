FROM php:8.2-apache

# Enable Apache mod_rewrite for LavaLust routing
RUN a2enmod rewrite

# Copy project files to Apache web root
COPY . /var/www/html/

# Grant www-data user write permissions for session files & cache
RUN chown -R www-data:www-data /var/www/html

# Adjust Apache configuration to allow htaccess overrides
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

EXPOSE 80