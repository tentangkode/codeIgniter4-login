# CodeIgniter 4 Login System

Login system example using Codeigniter 4 from scracth 

## Installation Guide

Clone this repository\
`git clone https://github.com/jeypc/codeIgniter4-login.git`

Run `composer install` to install all required packages

Rename `env` file to `.env`

Create a new database called `ci4login` or whatever you prefer, and then open `.env` file and set database name

Run migrations to create the tables\
`php spark migrate`

Run seeder to insert some dummy data\
`php spark db:seed UserSeeder`

and finally run local server development to start the app\
`php spark serve`

## Server Requirements

PHP version 7.2 or higher is required, with the following extensions installed: 

- [intl](http://php.net/manual/en/intl.requirements.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- xml (enabled by default - don't turn it off)
