FROM richarvey/nginx-php-fpm:latest

COPY . .

# Image Configuration
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel Configuration
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

# Allow Composer to run as root during build
ENV COMPOSER_ALLOW_SUPERUSER 1

CMD ["/start.sh"]