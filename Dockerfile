FROM richarvey/nginx-php-fpm:latest

# Copy application files
COPY . /var/www/html

# Fix permissions for Laravel storage and cache
RUN chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache

# Install dependencies during the BUILD phase
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts --working-dir=/var/www/html

# Image configuration
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1
ENV PHP_CATCHALL true

# Laravel configuration
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

CMD ["/start.sh"]