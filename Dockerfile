# Use an official PHP image with Apache
FROM php:8.0-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY msms/* /var/www/html/
# Copy install.php (though we aim to bypass its direct use)
COPY install.php /var/www/html/install.php
# Set permissions for Apache
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Expose port 80
EXPOSE 80

# Apache's default document root is /var/www/html.
# The entrypoint is handled by the base image (starts Apache).
# We might need to configure Apache to point to a subdirectory if the app's entry isn't at the root of /var/www/html.
# For this project, it seems the main app is in /msms, so we might need to adjust Apache config or redirect.
# However, install.php is at the root.
# Let's assume for now that accessing /install.php or /msms/index.php directly is acceptable.
# If a cleaner root path is needed, we'll adjust Apache's DocumentRoot or add a .htaccess redirect later.
