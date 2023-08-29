# Simple CMS
## Technology
### Backend
- Laravel V10.10
- Mysql

### Frontend
 - Vue3

## Pre requisite

- PHP 8.1+
- Node JS
- NPM

## Installation Process

- `git clone https://github.com/mh-shuvo/simple-cms.git`
- `cd simple-cms`
- `cp .env.example .env`
- `composer install`
- Update `.env` file according to your database choice
- `php artisan key:generate`
- `php artisan migrate`
- `php artisan db:seed` to create dummy users and content pages.
- `npm run build` for build the admin frontend
- `php artisan serve` to start the backend server
- `cd vue-frontend`
- `cp .env.example .env`
-  Update `.env` file based on backend
- `npm install`
- `npm run dev`


## API Documentation
Here I Add the API documentation which generated by the Postman.
[Documentation Link](https://documenter.getpostman.com/view/6303225/2s9Y5YSNmm)

    NB: When you seed the dummy data the system generate 10 users and 10 dummy content. 
    The users password is "password". 
