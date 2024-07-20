FROM webdevops/php-nginx:8.2-alpine

# Install dependencies
RUN apk add --no-cache \
    git \
    unzip \
    curl \
    npm

# Copy configuration files
COPY ./dockerizer/php.ini /opt/docker/etc/php/php.ini
COPY ./dockerizer/vhost.conf /opt/docker/etc/nginx/vhost.conf

# Copy composer files and set work directory
WORKDIR /app
COPY composer.json composer.lock ./

# Install Composer dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-interaction --no-scripts --no-suggest --prefer-dist --optimize-autoloader --verbose

# Copy the rest of the application code
COPY . .

# Run npm commands
RUN npm install && npm run build

# Run Laravel command
RUN php artisan storage:link

# Set permissions if necessary
RUN chown -R application:application /app/storage /app/bootstrap/cache

# Seed database
RUN php artisan migrate:fresh --seed
