<?php
use FilippoFinke\Router;
use FilippoFinke\Middleware\ContentLengthMiddleware;
use FilippoFinke\RouteGroup;

require __DIR__ . '/../vendor/autoload.php';

$router = new Router();

$group = new RouteGroup();
$group->add(
    $router->get('/', function ($req, $res) {
        return $res->withText('/ with GET');
    }),
    $router->post('/', function ($req, $res) {
        return $res->withText('/ with POST');
    })
);

$group->before(function ($req, $res) {
    $res->withHeader('Test-Middlware', 'Before');
});

$router->start();
