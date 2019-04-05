<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
CRUD API Exercise
</p>

## Local Development Environment
Bitnami WAMP Stack 7.1.27 on MS Windows 10
  - PHP 7.1.27
  - Apach 2.4
  - MySQL 5.7.23
  - Laravel 5.8
  - IDE : Visual Studit Code for 
  - API request testing with Postman

## Development Flow
1. Fork the Laravel Framework to my personal GitHub account : #gitlym
2. Clone them to local project folder
3. CLI with 'composer update'
4. CLI with 'php artisan migrate'
5. CLI with 'php artisan make:auth'
6. Add first_name and last_name columns in the users table
7. Add first_name and last_name fillable values in the user model
8. Add API endpoints to routes : web.php
9. Create UserController for API request and response methods
10. Commit and push to my personal GitHub : #gitlym

## API request manual
1. [GET] /users
  - Response : List of the current users in JSON format


2. [POST] /users/create
  - Requirement : must have first name, last name and unique email
  - Request Parameters
	'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'unique:users,email','string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'max:50'],
  - Response : stored user data in JSON format


3. [POST] /users/update/{id}
  - Requiredment : email can not be updated, at least one field must be changed
  - Request Parameters
	'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'password' => ['required', 'string', 'max:50'],
  - Response : update result with request user id

  ## Database structure file
  laravel.sql
  or
  You can simply execute CLI with 'php artisan migrate' to add first_name and last_name to users table
