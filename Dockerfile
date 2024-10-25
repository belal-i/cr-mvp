FROM php:8.3-apache

# Apache configuration
RUN a2enmod rewrite

# Update APT and install missing required PHP extensions
RUN apt-get update \
    && apt-get install -y libicu-dev libzip-dev default-mysql-client \
    && docker-php-ext-configure intl \
    && docker-php-ext-configure zip \
    && docker-php-ext-configure pdo_mysql \
    && docker-php-ext-install intl zip pdo_mysql
# These extensions are also required, but included with the base image.
# xml
# mbstring
# php-curl

# Install Composer and NPM
RUN curl -sS https://getcomposer.org/installer \
    | php -- --install-dir=/usr/local/bin --filename=composer \
    && apt-get install -y npm

# Copy code into container, install dependencies, build frontend assets.
ENV WORKING_DIRECTORY=/var/www/html
ENV APACHE_DOCUMENT_ROOT=$WORKING_DIRECTORY/public
COPY . $WORKING_DIRECTORY
WORKDIR $WORKING_DIRECTORY
RUN composer install && npm install && npm run production

# TODO: Make this more secure.
RUN chown -R www-data:www-data .

# TODO: This is quite hacky, but it's taken from the official docs...
# However, we might have to use Nginx / reverse proxy anyway, for SSL stuff,
# and that makes this moot... 
# and that would require a different base image... php-fpm or something like that...
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

EXPOSE 80/tcp

ENTRYPOINT ["./entrypoint.sh"]
CMD ["apache2-foreground"]
