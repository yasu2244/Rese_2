FROM php:7.4.9-fpm

# カスタム php.ini を配置
COPY php.ini /usr/local/etc/php/

# 必要な依存関係と GD ライブラリをインストール
RUN apt update \
  && apt install -y \
    default-mysql-client \
    zlib1g-dev \
    libzip-dev \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install pdo_mysql zip gd \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/*

# Composer をインストール
RUN curl -sS https://getcomposer.org/installer | php \
  && mv composer.phar /usr/local/bin/composer \
  && composer self-update

# 作業ディレクトリを設定
WORKDIR /var/www
