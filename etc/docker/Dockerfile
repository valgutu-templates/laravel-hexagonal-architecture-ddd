# Multi-stage build
ARG PHP_VERSION=8.0.14

FROM php:${PHP_VERSION}-fpm AS base

# This user and group must have id's corresponding to the user on the server
# in this case we create a user/group finixio 1001:1001 so we can write to our log files
ARG USER_ID=1001
ARG GROUP_ID=1001

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

RUN delgroup $(GROUP_ID) || true \
    groupadd --gid $GROUP_ID app \
    && useradd --create-home \
    --home-dir /home/app \
    --shell /bin/bash \
    --uid $USER_ID \
    app

WORKDIR $APP_DIR

COPY ./../../bin bin/

# Install extensions
RUN docker-php-ext-install pdo_mysql zip exif pcntl
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/
RUN docker-php-ext-install gd

# Using USER directive before WORKDIR would not create app directory belonging to user so we must change owner here
RUN chown -R $USER_ID:$GROUP_ID $APP_DIR

# Change current user to app
USER app

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]

# local Development environment
FROM base AS local

USER root

USER app
COPY vendor* vendor/
