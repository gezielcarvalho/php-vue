FROM php:8.4.14-apache

# Install dependencies
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash -

RUN apt-get update 

RUN apt-get install -y wget git nodejs libzip-dev zip libmcrypt-dev libmagickwand-dev vim default-mysql-client netcat-traditional --no-install-recommends 

RUN pecl install imagick 

RUN docker-php-ext-enable imagick 

RUN docker-php-ext-install mysqli pdo pdo_mysql zip pcntl bcmath 

# JPEG - https://stackoverflow.com/a/52892313/2190689
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Configure Apache for PHP MVC
RUN mkdir -p /var/www/html/public

RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf

RUN a2enmod rewrite 

# Set correct permissions
RUN usermod -u 1000 www-data
RUN chown -R www-data:www-data /var/www/html

# Copy entrypoint script
COPY entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/entrypoint.sh

# Set working directory
WORKDIR /var/www/html

# Expose port
EXPOSE 80

# Use custom entrypoint
ENTRYPOINT ["entrypoint.sh"]