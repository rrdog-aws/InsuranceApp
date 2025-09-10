FROM nginx:alpine

WORKDIR /var/www/html

# Copy app files (optional if shared volume used)
COPY ../ /var/www/html

# Copy Nginx configuration
COPY nginx.conf /etc/nginx/conf.d/default.conf

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]
