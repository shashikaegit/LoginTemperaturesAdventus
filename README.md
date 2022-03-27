## Technologies
- Laravel Framework 7.30.6 
- VueJs
- MySql

## Installation
- Clone Project
- Run composer install
- Run CREATE DATABASE [database_name] in MySql
- Rename file .env.example to .env
- Change/ Add your MySql credentials in .env file
  - DB_CONNECTION=mysql
  - DB_HOST=[database_host]
  - DB_PORT=[database_port]
  - DB_DATABASE=[database_name]
  - DB_USERNAME=[database_username]
  - DB_PASSWORD=[database_password]
- Add open weather API Key in to .env
  - OPEN_WEATHER_APP_KEY = 8dc9ba99c4e5fe28f4dc20edbc1848c0
- Run php artisan key:generate
- Run php artisan migrate
- Run npm install
- Run npm run dev
- Run php artisan serve
