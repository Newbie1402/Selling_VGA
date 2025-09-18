FROM php:8.0-apache

# Cài đặt extension mysqli và các extension thường dùng khác
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Bật mod rewrite cho Apache
RUN a2enmod rewrite

# Copy cấu hình Apache (tùy chọn)
# COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# Cài đặt các công cụ thường dùng
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    git \
    curl

# Đặt thư mục làm việc
WORKDIR /var/www/html

# Expose port 80
EXPOSE 80

# Khởi động Apache
CMD ["apache2-foreground"]
