FROM php:7.3-alpine

COPY . /

CMD php -S localhost:80 app/public/index.php