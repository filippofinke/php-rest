<?php
use FilippoFinke\Router;

require __DIR__ . '/../vendor/autoload.php';


$first = function ($req, $res) {
    $res->append('first');
};

$second = function ($req, $res) {
    $res->append('second');
};

$router = new Router();

$router->before($first);

$router->get('/', function ($req, $res) {
    return $res->withStatus(200);
})->after($second)->after($second);

$router->start();
