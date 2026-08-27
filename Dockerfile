# TRIV Design & Construction — PHP + Apache image
# Runs on Render, Railway, Fly.io, or any Docker host.
FROM php:8.2-apache

# MySQL driver + GD (used for image handling)
RUN apt-get update \
 && apt-get install -y --no-install-recommends libpng-dev libjpeg-dev libfreetype6-dev \
 && docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install -j"$(nproc)" pdo_mysql gd \
 && a2enmod rewrite headers \
 && rm -rf /var/lib/apt/lists/*

# Production PHP settings + room for plan/resume uploads
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" \
 && printf '%s\n' \
      'upload_max_filesize = 10M' \
      'post_max_size = 12M' \
      'display_errors = Off' \
      'log_errors = On' \
      'error_log = /dev/stderr' \
      'expose_php = Off' \
    > "$PHP_INI_DIR/conf.d/triv.ini"

WORKDIR /var/www/html
COPY . /var/www/html/

# Upload targets must be writable by Apache
RUN mkdir -p uploads/plans uploads/resumes assets/images \
 && chown -R www-data:www-data /var/www/html \
 && rm -f /var/www/html/.DS_Store /var/www/html/assets/.DS_Store /var/www/html/triv_db.sql

# Allow the committed .htaccess files to take effect
RUN printf '%s\n' \
      '<Directory /var/www/html>' \
      '    Options -Indexes +FollowSymLinks' \
      '    AllowOverride All' \
      '    Require all granted' \
      '</Directory>' \
    > /etc/apache2/conf-available/triv.conf \
 && a2enconf triv

COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 80
ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["apache2-foreground"]
