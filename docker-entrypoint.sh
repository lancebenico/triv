#!/bin/sh
set -e

# Render/Railway inject the port to bind on; default to 80 elsewhere.
PORT="${PORT:-80}"
sed -ri "s/^Listen [0-9]+$/Listen ${PORT}/" /etc/apache2/ports.conf
sed -ri "s/<VirtualHost \*:[0-9]+>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf

# Silence the "could not reliably determine server's fully qualified domain name" warning
echo "ServerName localhost" > /etc/apache2/conf-available/servername.conf
a2enconf servername >/dev/null 2>&1 || true

exec "$@"
