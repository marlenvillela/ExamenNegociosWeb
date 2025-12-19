FROM php:8.2-apache

RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN a2enmod rewrite

# Definir index.php como archivo principal
RUN echo "DirectoryIndex index.php index.html" > /etc/apache2/conf-available/directoryindex.conf \
    && a2enconf directoryindex

COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html
