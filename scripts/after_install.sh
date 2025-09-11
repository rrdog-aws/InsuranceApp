#!/bin/bash
# Set ownership for nginx/php-fpm
chown -R nginx:nginx /var/www/html

# Set directory and file permissions
find /var/www/html -type d -exec chmod 755 {} \;
find /var/www/html -type f -exec chmod 644 {} \;

# Restart services
systemctl restart nginx
systemctl restart php-fpm
