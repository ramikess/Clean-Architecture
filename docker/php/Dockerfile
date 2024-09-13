FROM php:8.3.10-fpm-bullseye

RUN echo '-= BUILD PHP IMAGE =-'

# ↓ Note: nodejs, python used for gulp ↓
RUN apt update && apt install -y --no-install-recommends \
        bzip2 \
        git \
        libzip-dev \
        libfontconfig \
        libfreetype6-dev \
        libicu-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libxml2-dev \
        ssh \
        unzip \
        vim \
        wget \
        wkhtmltopdf \
        zlib1g-dev \
    && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install \
        calendar \
        exif \
        gd \
        iconv \
        intl \
        pdo_mysql \
        soap \
        sockets \
        zip \
    && apt clean && apt autoremove -y \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version="2.1.12"  && \
    composer --version && \
    mkdir /var/www/.composer

# Set timezone
RUN rm /etc/localtime && \
    ln -s /usr/share/zoneinfo/Europe/Paris /etc/localtime && \
    "date"

WORKDIR /var/www/symfony

CMD ["php-fpm"]
