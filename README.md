## Start

### Install dependencies
composer install

npm install

### Initialize env 

cp .env.example .env

php artisan key:generate

### Initialize database
#### For Unix

touch database/database.sqlite

#### For windows (in terminal I have powershell)

New-Item -Path .\database\database.sqlite -ItemType File

### Populate database

php artisan migrate

php artisan db:seed

### Run application

php artisan serve

in another terminal - npm run dev => click on APP_ENV link


# Problems 

Rarely but happens, Add to cart doesnt work due to CSRF token mismatch. Even though it is set up in axios.js