# Use an official PHP runtime as the base image
FROM php:8.1-apache

# Set the working directory in the container
WORKDIR /var/www/html

# Install PHP extensions and dependencies
RUN docker-php-ext-install pdo_mysql
RUN apt-get update && apt-get install -y libonig-dev libzip-dev zip unzip
RUN docker-php-ext-install mbstring zip

# Enable Apache module and rewrite rules
RUN a2enmod rewrite

# Copy the project files to the working directory
COPY . .

# Install Composer dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --optimize-autoloader --no-dev

# Set the file permissions
RUN chown -R www-data:www-data /var/www/html/storage

# Expose the port on which the application will run (adjust if necessary)
EXPOSE 80

# Define the command to run your application
CMD ["apache2-foreground"]
