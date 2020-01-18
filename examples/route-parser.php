<?php
use FilippoFinke\Router;

require __DIR__ . '/../vendor/autoload.php';


$router = new Router();

$router->get('/comments/{comment_id:[0-9]}', function($req, $res) {
    return $res->withText("Comment id: ".$req->getAttribute("comment_id"));
});

$router->get('/{name}', function($req, $res) {
    $name = $req->getAttribute('name');
    return $res->withText("Hi ".$name."!");
});

$router->get('/', function($req, $res) {
    return $res->withText("Hi anonymous user!");
});


$router->start();