FROM php:7.4-cli

RUN apt-get update && apt-get install -y git

WORKDIR /app

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]

EXPOSE 8000
