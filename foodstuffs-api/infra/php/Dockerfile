FROM php:8.1.4-fpm

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions pdo_mysql

COPY --from=composer:2.2 /usr/bin/composer /usr/local/bin/composer