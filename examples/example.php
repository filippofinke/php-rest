<?php
use FilippoFinke\Router;

require __DIR__ . '/../vendor/autoload.php';

$router = new Router();

$router->get('/', function ($req, $res) {
    $html = sprintf("<b>Request</b> from %s to %s with method %s<br>%s", $req->getRemoteAddress(), $req->getUri(), $req->getMethod(), date("H:i:s d/m/Y", $req->getTime()));
    $html .= "<br>Headers:";
    foreach($req->getHeaders() as $header => $value) {
        $html .= "<br>$header = $value";
    }
    $html .= "<br>Params:";
    foreach($req->getParams() as $param => $value) {
        $html .= "<br>$param = $value";
    }
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

$router->post('/', function ($req, $res) {
    return $res->withText('You are using POST!');
});

$router->put('/', function ($req, $res) {
    return $res->withJson($req->getParams());
});

$router->delete('/', function ($req, $res) {
    return $res->withJson($req->getParams());
});

$router->start();
