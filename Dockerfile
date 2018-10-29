FROM webdevops/php-nginx:7.2

# Install required dependencies

## php-ast is required to run phan
RUN pecl install ast

# Copy custom php.ini settings
COPY docker-config/php/php.ini /opt/docker/etc/php/php.ini

# Copy application files. Only the necessary ones.
COPY /src /app
COPY /public /app/public
COPY composer.json /app/composer.json

# Run the composer install
RUN cd /app && composer install