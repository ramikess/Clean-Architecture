FROM php:8.3.10-fpm

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

RUN apt update \
    && apt install -y git acl openssl openssh-client wget zip vim libssh-dev \
    && apt install -y libpng-dev zlib1g-dev libzip-dev libxml2-dev libicu-dev \
    && docker-php-ext-install intl pdo pdo_mysql zip

RUN apt install -y librabbitmq-dev \
    && pecl install amqp xdebug \
    && docker-php-ext-enable --ini-name 05-opcache.ini opcache amqp xdebug


# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version="2.1.12"  && \
    composer --version && \
    mkdir /var/www/.composer

# Set timezone
RUN rm /etc/localtime && \
    ln -s /usr/share/zoneinfo/Europe/Paris /etc/localtime && \
    "date"

WORKDIR /var/www/symfony

COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
CMD ["php-fpm"]

