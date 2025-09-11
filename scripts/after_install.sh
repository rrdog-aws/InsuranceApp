#!/bin/bash
# Ensure correct ownership for web server
chown -R nginx:nginx /var/www/html

# Fix permissions: dirs 755, files 644
find /var/www/html -type d -exec chmod 755 {} \;
find /var/www/html -type f -exec chmod 644 {} \;

# Ensure index.php exists at web root
if [ -f /var/www/html/php-fpm/index.php ]; then
    cp /var/www/html/php-fpm/index.php /var/www/html/index.php
    chown nginx:nginx /var/www/html/index.php
    chmod 644 /var/www/html/index.php
fi

# Restart services
systemctl restart nginx
systemctl restart php-fpm
