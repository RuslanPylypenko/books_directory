FROM php:8.2-cli-alpine

# Install required packages and extensions
RUN apk add --no-cache libpq postgresql-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Install Composer globally
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

# Set the working directory
WORKDIR /var/www

# Start the cron service in the background
CMD ["crond", "-f"]