FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git unzip zip libpq-dev libzip-dev nodejs npm \
    && docker-php-ext-install pdo pdo_pgsql zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN if [ -f package-lock.json ]; then npm ci; else npm install; fi \
    && npm run prod || npm run build || true

RUN chown -R www-data:www-data storage bootstrap/cache

RUN a2enmod rewrite

RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

COPY docker/start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

CMD ["/usr/local/bin/start.sh"]