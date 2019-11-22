<?php
use FilippoFinke\Router;
require __DIR__ . '/../vendor/autoload.php';

$router = new Router();

$router->get('/', function($req, $res) {
    printf("Request from %s to %s with method %s", $req->getRemoteAddress(), $req->getUri(), $req->getMethod());
});

$router->start();