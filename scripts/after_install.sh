#!/bin/bash
# Set permissions
chmod 755 /var/www/html/*

# Restart nginx
systemctl restart nginx

# Restart php-fpm
systemctl restart php-fpm
