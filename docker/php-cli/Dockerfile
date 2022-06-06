FROM php:8.1-cli

RUN apt-get update && apt-get install -y \
    libpq-dev \
    wget \
    zlib1g-dev \
    libmcrypt-dev \
    libzip-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libicu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl

# git нужен для работы с рецептами для пэкаджей из папки vendor
RUN apt-get -y update
RUN apt-get -y install git

# памяти не хватает для выполнения composer recipes:update
RUN echo 'memory_limit = 256M' >> /usr/local/etc/php/conf.d/docker-php-memory_limit.ini;

RUN docker-php-ext-install pdo pdo_mysql zip
RUN apt-get update && apt-get install -y unzip \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN wget https://getcomposer.org/installer -O - -q | php -- --install-dir=/bin --filename=composer --quiet

RUN echo 'deb [trusted=yes] https://repo.symfony.com/apt/ /' | tee /etc/apt/sources.list.d/symfony-cli.list\
    && apt update \
    && apt install symfony-cli

RUN useradd -d /home/develop -m -s /bin/bash develop && echo "develop:develop" | chpasswd && adduser develop sudo

WORKDIR /project

RUN chown -R develop:develop /project
USER develop