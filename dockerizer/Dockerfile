FROM webdevops/php-nginx:8.2-alpine

COPY ./dockerizer/php.ini /opt/docker/etc/php/php.ini
COPY ./dockerizer/vhost.conf /opt/docker/etc/nginx/vhost.conf
COPY composer.json composer.lock /app/
RUN composer install --no-interaction --no-scripts --no-suggest --vvv
RUN npm install && npm run build
RUN php artisan storage:link
COPY . /app
