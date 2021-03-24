FROM php:7.4-apache

ENV DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN echo 'ServerName localhost' >> /etc/apache2/apache2.conf
RUN rm /var/log/apache2/access.log

RUN echo 'upload_max_filesize = 20M\n post_max_size = 20M\n memory_limit = 500M' > /usr/local/etc/php/conf.d/uploads.ini  

RUN a2enmod rewrite
RUN a2enmod deflate
RUN apt-get update -y
RUN apt-get install -y libpng-dev libjpeg62-turbo-dev libfreetype6-dev zlib1g-dev libzip-dev unzip
RUN docker-php-ext-configure gd --with-jpeg --with-freetype
RUN docker-php-ext-install -j$(nproc) gd
RUN docker-php-ext-install zip
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer