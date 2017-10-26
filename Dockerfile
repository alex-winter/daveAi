FROM php:7.1-alpine

# Base environment provisioning
RUN apk add --update --no-cache bash icu-dev \
    && docker-php-ext-install \
    intl \
    pdo \
    pdo_mysql

# Set working directory
WORKDIR /app

# Copy application files
COPY vendor vendor
COPY bootstrap bootstrap
COPY src src

ENTRYPOINT ["/app/bootstrap/run"]
