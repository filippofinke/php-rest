# php-rest

---

## Description

A very simple, basic and powerful rest api framework.

## Install

```
composer require filippofinke/php-rest
```

```php
<?php
use FilippoFinke\Router;
require __DIR__ . '/../vendor/autoload.php';

$router = new Router();
// Do your stuff
```

## Add a route

```php
<?php
use FilippoFinke\Router;
require __DIR__ . '/../vendor/autoload.php';

$router = new Router();

// Add a get route
$router->get('/', function($req, $res) {
    // Route / logic for get
});

// Add a get route with regex
$router->get('/([a-zA-Z]*)', function($req, $res) {
    // Get regex match
    $name = $req->getAttribute('args')[1];
    // Route logic
});

// Add a post route
$router->post('/', function($req, $res) {
    // Route / logic for post
});

// Add multiple methods route
$router->map(['get', 'post'], '/', function($req, $res) {
    // Route / logic for get and post
});
```

## Request

```php
<?php
use FilippoFinke\Router;
require __DIR__ . '/../vendor/autoload.php';

$router = new Router();

$router->get('/', function($req, $res) {

    // See all methods in src/Request.php

    // Get request ip address
    $address = $req->getRemoteAddress();
    // Get request parameters
    $params = $req->getParams();

    $response = array();
    $response[] = $address;
    $response[] = $params;

    // Return response
    return $res->withJson($response);

});

```

## Response

```php
<?php
use FilippoFinke\Router;
require __DIR__ . '/../vendor/autoload.php';

$router = new Router();

$router->get('/', function($req, $res) {

    // See all methods in src/Response.php

    // Add header
    $req->withHeader('Test-Header', 'Value');

    // Response with text
    $req->withText('This is the / route');

    // Append text to the content
    $req->append(PHP_EOL.'a new line');

    // Set status, default 200
    $req->setStatus(200);

    // You can also call all of these methods as a chain
    //  $req->withHeader('Test-Header', 'Value')->withText('This is the / route')->setStatus(200);

    // Return response
    return $res;

});

```

## Redirect

```php
<?php
use FilippoFinke\Router;
require __DIR__ . '/../vendor/autoload.php';

$router = new Router();

$router->get('/', function($req, $res) {
    // Redirect to route and with status code
    return $res->redirect('/login')->withStatus(301);
});

```

## Before and after middlewares

```php
<?php
use FilippoFinke\Router;
require __DIR__ . '/../vendor/autoload.php';

$router = new Router();

$before = function($req, $res) {
    $req->withHeader("Before-Header", time());
};

$after = function($req, $res) {
    $req->withHeader("After-Header", time());
};

// Add a get route
$router->get('/', function($req, $res) {
    // Route / logic for get
})
// Add before middleware
->before($before);
// Add after middleware
->after($after)
```
