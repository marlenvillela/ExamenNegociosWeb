FROM php:8.2-apache


RUN docker-php-ext-install pdo pdo_mysql mysqli

RUN a2enmod rewrite


COPY . /var/www/html/


RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

RUN sed -i 's|/var/www/html|/var/www/html|g' /etc/apache2/sites-available/000-default.conf
