FROM webdevops/php-nginx:8.2-alpine

# Install dependencies
RUN apk add --no-cache \
    git \
    unzip \
    curl \
    npm \
    certbot \
    certbot-nginx

# Copy configuration files
COPY ./dockerizer/php.ini /opt/docker/etc/php/php.ini
COPY ./dockerizer/vhost.conf /opt/docker/etc/nginx/vhost.conf

# Set work directory
WORKDIR /app

# Copy composer files and install dependencies
COPY composer.json composer.lock ./
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-interaction --no-scripts --no-suggest --prefer-dist --optimize-autoloader --verbose

# Copy application files
COPY . .

# Run npm commands
RUN npm install && npm run build

# Run Laravel artisan commands
RUN php artisan migrate:fresh --seed --force

# Set permissions if necessary
RUN chown -R application:application /app/storage /app/bootstrap/cache

EXPOSE 80 443
CMD ["supervisord"]
