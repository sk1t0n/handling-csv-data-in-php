FROM php:8.2-fpm

WORKDIR /var/www/app

RUN apt-get update && \
	  apt-get install -y --no-install-recommends git zip unzip && \
	  apt-get clean && rm -rf /var/lib/apt/lists/*

COPY composer.json composer.lock ./
COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN composer install --no-progress --no-autoloader --no-scripts

COPY . ./

RUN chown -R www-data:www-data ./ && \
	  composer dump-autoload --optimize --dev

USER www-data

EXPOSE 9000
CMD ["php-fpm"]
