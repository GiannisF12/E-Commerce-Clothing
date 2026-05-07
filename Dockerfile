FROM php:8.2-apache

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

RUN a2enmod rewrite

COPY . /var/www/html/

COPY php.ini /usr/local/etc/php/conf.d/custom.ini

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/img

EXPOSE 80
