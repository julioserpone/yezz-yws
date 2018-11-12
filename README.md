# Akkar Global Services

This document provides you with an insight into the most important things to develop for the Akkar Global Services Project

## Overview

1. [Requirements](#requirements)
2. [Setup](#setup)
   1. [Project](#project)
   1. [Homestead](#homestead)
3. [Structure](#structure)
   1. [MVC](#mvc-model-view-controller)
   2. [Public assets](#public-assets)
   3. [Commands](#commands)
   4. [Config](#config)
   5. [Middleware](#middleware)
   6. [Requests](#requests)
4. [Cache](#cache)
5. [Guidlines](#guidlines)
   1. [Namespace](#namespace)
   2. [Queries](#queries)
   3. [Routes](#routes)
   4. [Controllers](#controllers)
   5. [Variable Namings](#variable-namings)

## Requirements
1. PHP 5.5+
2. MySQL 5.5+
3. Apache2 or Nginx webserver
4. [Composer](https://getcomposer.org/)
5. PHP fileinfo extension
6. GIT 1.6+

## Setup

##### Project

Clone gitlab repository
```
git clone https://gitlab.com/development.yezzcorp/akkarglobalservices.git
```

Enter project directory and run dependency install
```
composer install # or composer.phar if your composer file is not global
```

Install dependency client-side with bower
```
bower install/update
```

Run Fresh migrations with seeds
```
php artisan migrate:refresh --seed
```

Asign Key to App
```
php artisan key:generate
```

Setup your enviroment file .env from basic file .env.example


##### Homestead

For get timezone actual
```
date +'%:z %Z'
```

Set timezone server in file after.sh (Windows: %FOLDERUSER%/.homestead/after.sh)
```
sudo ln -sf /usr/share/zoneinfo/America/Caracas /etc/localtime
```

Execute command provision for vagrant and restart your server
```
vagrant provision
```

## Structure

##### MVC (Model-View-Controller)
- [Models](http://laravel.com/docs/5.2/eloquent) - app/Models
- [Views](http://laravel.com/docs/5.2/views) - resources/views/
- [Front-end Controllers](http://laravel.com/docs/5.2/controllers) - app/Http/Frontend/Controllers/
- [Back-end Controllers](http://laravel.com/docs/5.2/controllers) - app/Http/Backend/Controllers/

##### Public assets
- Assets are stored in public/ directory
- JS files - public/js/
- CSS files - public/css/
- Images - public/img/
- Fonts files - public/fonts/
- Plugins Jquery files - public/plugins/

##### [Config](http://laravel.com/docs/5.2/configuration)

- Main configuration you can find in your enviroment file ( .env ) under project root directory
- Configuration files are listed under config/ directory

##### [Middleware](http://laravel.com/docs/5.2/middleware)

- Listed under app/Http/Middleware directory
- Also known as filters
- Must be registred under app/Http/Kernel.php

Global middlewares list under
```
protected $middleware = [];
```

Route middlewares list under
```
protected $routeMiddleware = [];
```

##### [Requests](http://laravel.com/docs/5.2/requests)

- Listed under app/Http/Requests
- Request is validator for method used on



## Guidlines

##### Namespace

- Use namespaces for each class
- Follow PSR-2 Standard for namespace

```
<?php

namespace Creame\Controllers;
```

##### Queries

- For larger data please use plain queries instead of eloquent.
- Queries are stored into Models as static method
- Do not use queries in loop. For that you can use eager loading

##### Routes

- Do not use Closure in routes.php

##### Controllers

- Make resource controllers only for the methods you will use instead of all
- Use camealCase for naming conventions instead of snake_case
```
public function helloWorld()
{

}
```

##### Variable namings

- Use camealCase for naming conventions instead of snake_case
```
$helloWorld = 10;
```
- Make readable namings.
