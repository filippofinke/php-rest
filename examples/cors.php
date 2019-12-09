<?php
use FilippoFinke\Router;
use FilippoFinke\Middleware\CorsMiddleware;

require __DIR__ . '/../vendor/autoload.php';

$cors = new CorsMiddleware('http://localhost', ['GET','POST','PUT','DELETE']);

$router = new Router();
$router->before($cors);

$router->map(['GET','POST','PUT','DELETE'], '/', function ($req, $res) {
    return $res->withStatus(200)->withText("Method: ".$req->getMethod()."!");
});

$router->start();
