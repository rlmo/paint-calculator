FROM wyveo/nginx-php-fpm

COPY ./ /usr/share/nginx/html
COPY nginx.conf /etc/nginx/conf.d/default.conf

WORKDIR /usr/share/nginx/html

RUN ln -s public html
RUN apt update;

CMD cp .env.example .env; \
    composer install; \
    php artisan key:generate; \
    /start.sh

EXPOSE 8000