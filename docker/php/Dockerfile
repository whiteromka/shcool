FROM php:8.3-fpm-alpine

ARG UID
ARG GID

RUN apk add --no-cache \
    bash \
    git \
    unzip \
    curl \
    oniguruma-dev \
    zip \
    mysql-client \
    icu-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring pcntl intl xml opcache

# пользователь = rom (UID 1000)
RUN addgroup -g ${GID} appgroup \
    && adduser -D -G appgroup -u ${UID} appuser

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Laravel writable dirs
#RUN mkdir -p storage bootstrap/cache \
#    && chown -R appuser:appgroup storage bootstrap/cache

USER appuser

EXPOSE 9000
