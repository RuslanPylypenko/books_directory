FROM php:8.2-cli-alpine

RUN apk add --no-cache libpq postgresql-dev bash \
    && docker-php-ext-install pdo pdo_pgsql ftp

COPY ./common/wait-for-it.sh /usr/local/bin/wait-for-it
RUN chmod 555 /usr/local/bin/wait-for-it

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

ARG PUID=1000
ARG PGID=1000

RUN apk --no-cache add shadow && \
    groupmod -o -g ${PGID} www-data && \
    usermod -o -u ${PUID} -g www-data www-data

RUN chown www-data:www-data /var/www
COPY --chown=www-data:www-data ./ /var/www

WORKDIR /var/www/api

USER www-data