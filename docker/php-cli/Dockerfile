FROM php:8.2-cli

RUN apt-get update -y && apt-get upgrade -y && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install zip pdo pdo_pgsql \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/bin --filename=composer --quiet \
    && rm -rf /root/.composer/cache

# Create a non-root user named "appuser" and set its default shell to /bin/bash
RUN useradd -ms /bin/bash appuser

# Switch to the "appuser" user for subsequent commands
USER appuser

WORKDIR /home/app
