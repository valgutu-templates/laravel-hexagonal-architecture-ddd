# Multi-stage build
ARG PHP_VERSION=8.0.14

FROM php:${PHP_VERSION}-fpm AS base

# Set working directory
ENV APP_DIR=/var/www

# install composer and config our php.ini
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    libzip-dev \
    unzip \
    git \
    curl

# Clear cache \
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

WORKDIR $APP_DIR
COPY bin bin/

# Install extensions
RUN docker-php-ext-install pdo_mysql zip exif pcntl
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/
RUN docker-php-ext-install gd

# Install composer
# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
COPY /app/ $APP_DIR

# Copy existing application directory permissions
COPY --chown=www:www . $APP_DIR

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]

# local Development environment
FROM base AS local

USER root

USER app
COPY vendor* vendor/
COPY node_modules* node_modules/
