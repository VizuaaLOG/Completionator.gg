# Based on - https://github.com/TrafeX/docker-php-nginx/blob/master/Dockerfile

FROM php:8.1-fpm-bullseye

# Setup document root
WORKDIR /var/www/html

# Install packages and remove default server definition
RUN apt-get update
RUN apt-get install -y \
    zip \
    curl \
    libcurl3-dev \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zlib1g-dev

RUN apt-get clean -y

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions

RUN install-php-extensions \
    gd \
    pdo_mysql \
    intl \
    opcache\
    curl \
    pdo \
    ctype \
    dom \
    mbstring \
    openssl \
    phar \
    session \
    xml \
    xmlreader \
    tokenizer \
    fileinfo \
    simplexml \
    zip \
    exif \
    imagick

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Copy INI file which overwrites some setting such as upload size
COPY ./.docker/php.ini-development "$PHP_INI_DIR/php.ini"

COPY ./src /var/www/html/
RUN mkdir /var/www/html/public/media
RUN chown -R www-data:www-data /var/www/html

VOLUME /var/www/html/public/media

RUN echo "Installing dependencies..."
RUN composer install --no-cache --no-dev