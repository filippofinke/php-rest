<?php
use FilippoFinke\Router;

require __DIR__ . '/../vendor/autoload.php';

$router = new Router();

$router->get('/', function ($req, $res) {
    $html = "<p>".$req->getAttribute('test')."</p><br>";
    $html .= sprintf("<b>Request</b> from %s to %s with method %s<br>%s", $req->getRemoteAddress(), $req->getUri(), $req->getMethod(), date("H:i:s d/m/Y", $req->getTime()));
    $html .= "<br>Headers:";
    foreach ($req->getHeaders() as $header => $value) {
        $html .= "<br>$header = $value";
    }
    $html .= "<br>Params:";
    foreach ($req->getParams() as $param => $value) {
        $html .= "<br>$param = $value";
    }
    return $res->append($html)->withHeader('Content-Type', 'text/html');
})->before(function ($req, $res) {
    $req->withAttribute('test', 'test attribute');
    $res->append('<p>before middleware</p><hr>');
})->after(function ($req, $res) {
    $res->append('<hr>after middleware!');
});

$router->get('/json', function ($req, $res) {
    return $res->withJson(
        array(
            'status' => true,
            'json' => [1,2,3,4,5]
        )
    );
});

$router->get('/redirect', function ($req, $res) {
    return $res->redirect('/json')->withStatus(301);
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
