FROM php:8.2.0-fpm-alpine

# Install packages
RUN apk add --no-cache curl git build-base zlib-dev oniguruma-dev autoconf bash && \
    echo "memory_limit=512M" >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini && \
    echo 'max_execution_time = 300' >> /usr/local/etc/php/conf.d/docker-php-maxexectime.ini;

RUN apk add --no-cache libpq postgresql-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Configure non-root user.
ARG PUID=1000
ARG PGID=1000

RUN apk --no-cache add shadow && \
    groupmod -o -g ${PGID} www-data && \
    usermod -o -u ${PUID} -g www-data www-data

# Source code
RUN chown www-data:www-data /var/www
COPY --chown=www-data:www-data ./ /var/www
WORKDIR /var/www

USER www-data

EXPOSE 9000