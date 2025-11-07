#!/bin/bash

echo "Starting PHP-Vue MVC Application..."

# Simple check if database host is reachable
if nc -z db 3306; then
    echo "Database is ready!"
else
    echo "Database not ready, starting anyway..."
fi

# Set proper permissions
chown -R www-data:www-data /var/www/html
chmod -R 755 /var/www/html

# Start Apache
echo "Starting Apache..."
exec apache2-foreground