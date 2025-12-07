#syntax=docker/dockerfile:1.4

# BUILD STAGE **********************************
FROM php:8.3-fpm-alpine AS builder

# install system dependencies
RUN sed -i 's/dl-cdn\.alpinelinux\.org/dl-cdn.alpinelinux.org/g' /etc/apk/repositories

RUN apk update && apk add --no-cache \
    git \
    curl \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    oniguruma-dev \
    postgresql-dev \         
    postgresql-client \ 
    zip \
    unzip \    
    bash

# install PHP extensions
RUN docker-php-ext-configure gd --with-jpeg --with-webp && \
    docker-php-ext-install pdo pdo_mysql pdo_pgsql bcmath mbstring gd zip

# install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www
COPY . .
RUN composer install --no-dev --optimize-autoloader






# FRONTEND STAGE **********************************
FROM node:20-alpine AS frontend
WORKDIR /app
COPY --from=builder /var/www .
RUN npm install && npm run build





# PRODUCTION STAGE **********************************
FROM php:8.3-fpm-alpine AS production

# install system dependencies
WORKDIR /var/www

# Copy compiled PHP extensions & configs from builder# Install runtime dependencies only
RUN apk update && apk add --no-cache \
    libpng \
    libjpeg-turbo \
    libwebp \
    libzip \
    oniguruma \
    postgresql-libs

# Copy from builder
COPY --from=builder /usr/local/etc/php/conf.d /usr/local/etc/php/conf.d
COPY --from=builder /usr/local/lib/php/extensions/no-debug-non-zts-20230831/ /usr/local/lib/php/extensions/no-debug-non-zts-20230831/

COPY --from=builder /var/www /var/www/
COPY --from=frontend /app/public/build /var/www/public/build
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache


EXPOSE 9000
CMD ["php-fpm"]





# WEBSERVER STAGE **********************************
FROM nginx:alpine AS webserver
COPY --from=production /var/www /var/www
COPY ./docker/nginx.conf /etc/nginx/nginx.conf
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]

