<?php
use FilippoFinke\Router;

require __DIR__ . '/../vendor/autoload.php';

$router = new Router();

$router->get('/', function ($req, $res) {
    $html = sprintf("<b>Request</b> from %s to %s with method %s", $req->getRemoteAddress(), $req->getUri(), $req->getMethod());
    return $res->withHtml($html);
});

$router->get('/json', function ($req, $res) {
    return $res->withJson(
        array(
            'status' => true,
            'json' => [1,2,3,4,5]
        )
    );
});

$router->start();
