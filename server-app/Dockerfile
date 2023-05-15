FROM wyveo/nginx-php-fpm

COPY ./ /usr/share/nginx/html
COPY nginx.conf /etc/nginx/conf.d/default.conf

WORKDIR /usr/share/nginx/html

RUN ln -s public html
RUN apt update; \
    apt install vim -y;

RUN cp .env.example .env
RUN composer install
RUN php artisan key:generate

EXPOSE 8000