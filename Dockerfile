FROM php:8.4-alpine

WORKDIR /app
RUN apk add --no-cache \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    libxpm-dev \
    freetype-dev \
    zip \
    unzip \
    git \
    curl \
    oniguruma-dev \
    icu-dev \
    libxml2-dev \
    bash \
    shadow \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp --with-xpm \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd intl xml

COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

COPY . /app

RUN composer install --no-interaction --prefer-dist --optimize-autoloader

RUN cp .env.example .env

RUN /usr/local/bin/php /app/artisan key:generate

RUN chown -R www-data:www-data /app

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0"]