FROM php:7.2-apache

# Install necessary packages and dependencies
RUN apt update && apt install -y \
    xvfb \
    libfontconfig \
    wkhtmltopdf \
    build-essential \
    python2 \
    python-pip \
    python-cffi \
    libcairo2 \
    libpango1.0-0 \
    libpangocairo-1.0-0 \
    libgdk-pixbuf2.0-0 \
    libffi-dev \
    shared-mime-info \
    && python2 -m pip install "weasyprint<43"

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql \
    && docker-php-ext-enable mysqli

# Create directory for application files
RUN mkdir -p /var/www/html

# Copy application files to the container
COPY www/ /var/www/html/

# Set the correct permissions for the application files
RUN chown -R www-data:www-data /var/www/html/ && \
    chmod -R 755 /var/www/html/

# Expose ports
EXPOSE 80 443

# Ensure that the Apache server runs in the foreground
CMD ["apache2ctl", "-D", "FOREGROUND"]
