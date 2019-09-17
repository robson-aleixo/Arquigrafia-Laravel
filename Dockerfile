FROM php:5.6-apache

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
    && docker-php-ext-install -j$(nproc) iconv mcrypt pcntl \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd


RUN docker-php-ext-install pdo_mysql
RUN a2enmod rewrite

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

COPY default.conf /etc/apache2/sites-enabled/000-default.conf

WORKDIR /var/www/app

COPY composer.json ./



# CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
# RUN COMPOSER_MEMORY_LIMIT=-1 composer install
# CMD ["php", "artisan", "serve"]
RUN composer install

COPY . .

EXPOSE 80

CMD ["php", "artisan", "serve"]
# RUN service apache2 restart

# ADD . /var/www/app
# ADD ./public /var/www/html
