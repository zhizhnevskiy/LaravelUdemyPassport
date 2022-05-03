## Run developing
- php artisan serve
## Install Passport
- composer require laravel/passport
## Do migration
- php artisan migrate
## Install Passport (IMPORTANT)
php artisan passport:install
## Add new clients to .env
- CLIENT_1=wjT3OQN44ISuel4RmVWl7TaQuzoLA4mdFZ5cdpLU
- CLIENT_2=wHjkvjNEN21MT90RdGcmPSn3HsY1DZlJVnxDc9aG
- CLIENT_3=nTJ2NGflIeroBZ6M1Ac1fJ8uNXjV833dZAHt4qHm
- CLIENT_4=E4pFnd0SUDJ1OOZnrFiDhgVIdCBytuUBJLePyVjD
## Make your own register Request
- php artisan make:request RegisterRequest
## Integrations with Mailtrap
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=c2438fbe5a63a3
MAIL_PASSWORD=31294a6f57fecf
MAIL_ENCRYPTION=tls
## Make Mail
- php artisan make:mail ForgotMail
## Generate key
php artisan key:generate
