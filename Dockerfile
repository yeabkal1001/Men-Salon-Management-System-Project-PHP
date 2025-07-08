# Use an official PHP image with Apache
FROM php:8.0-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Set working directory
WORKDIR /var/www/html

# Copy application files
# First, copy the main application directory
COPY msms/ /var/www/html/msms/
# Copy SQL file - though it will be used by mysql container, good to have it in context if needed
COPY SQL\ File/ /var/www/html/SQL\ File/
# Copy install.php (though we aim to bypass its direct use)
COPY install.php /var/www/html/install.php

# Copy other root files if necessary (e.g., .htaccess if any, or other specific configurations)
# For now, we assume the core app is in 'msms' and 'install.php' is at the root.
# If there are other specific root files like a global index.php or .htaccess, they should be copied too.
# Example: COPY .htaccess /var/www/html/

# Ensure correct permissions for Apache if needed
# RUN chown -R www-data:www-data /var/www/html
# RUN chmod -R 755 /var/www/html

# Expose port 80
EXPOSE 80

# Apache's default document root is /var/www/html.
# The entrypoint is handled by the base image (starts Apache).
# We might need to configure Apache to point to a subdirectory if the app's entry isn't at the root of /var/www/html.
# For this project, it seems the main app is in /msms, so we might need to adjust Apache config or redirect.
# However, install.php is at the root.
# Let's assume for now that accessing /install.php or /msms/index.php directly is acceptable.
# If a cleaner root path is needed, we'll adjust Apache's DocumentRoot or add a .htaccess redirect later.
