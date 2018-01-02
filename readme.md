## About NearbyShops

Implement an app that list shops nearby

## Overview

- Sign up using email and password
- Sign in using email and password
- Display list of shops sorted by distance
- Like a shop and display it in a new page
- Dislike a shop and remove it from the main page for 2 hours
- Remove a shop from the preferred shops

## Technologies used

- [Laravel 5.5](https://laravel.com/docs/5.5)
- [Vue 2.5.7](https://vuejs.org/)
- [axios](https://github.com/axios/axios)
- [Bootstrap 3.3.7](https://getbootstrap.com/docs/3.3/)
- [npm](https://www.npmjs.com/)
- [Webpack](https://webpack.js.org/)


## Requirement

- PHP 7.0.0 or newer
- HTTP server with PHP support (eg: Apache, Nginx, Caddy)
- [Composer](https://getcomposer.org/)
- MySQL database

## Quick Project Setup - Installation

##### 1. Clone the repository using the following command in terminal:

    git clone https://github.com/hamzaBentahar/nearbyshops.git nearbyshops
    
##### 2. Move to project root folder
    
    cd nearbyshops

##### 3. Install laravel dependencies:

    composer install
    
##### 4. Create Mysql database 
##### 5. Copy the example environment file
    copy .env.example .env
##### 6. Configure the  database in the ```.env``` file
1. Update value in DB_DATABASE with your database name
2. Update value in DB_USERNAME with your username
3. Update value in DB_PASSWORD with your password

##### 7. Setup database schema and then seed data
    php artisan migrate --seed

##### 8. Generate encryption key

    php artisan key:generate
    
##### 9. Start development server

    php artisan serve
    
##### 10. Access the application in the browser with the give url