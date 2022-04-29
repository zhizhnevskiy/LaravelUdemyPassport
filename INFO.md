## Run developing
- php artisan serve
## Install Passport
- composer require laravel/passport
## Do migration
- php artisan migrate
## Install Passport
php artisan passport:install
## Add new clients to .env
- CLIENT_1=wjT3OQN44ISuel4RmVWl7TaQuzoLA4mdFZ5cdpLU
- CLIENT_2=wHjkvjNEN21MT90RdGcmPSn3HsY1DZlJVnxDc9aG
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
