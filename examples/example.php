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

$testMiddleware = function ($req, $res) {
    $res->withHeader('Test-Middlware', 'Before');
};

$router->map(['post','put','delete'], '/', function ($req, $res) {
    $response[] = $req->getParams();
    return $res->withJson($response);
})->before($testMiddleware);

$router->get('/([a-zA-Z]*)', function ($req, $res) {
    $name = $req->getAttribute('args')[1];
    $text = 'Hello '.$name.'!';
    return $res->withText($text);
});

$router->get('/user/([0-9]*)', function ($req, $res) {
    $id = $req->getAttribute('args')[1];
    return $res->withText('User by id: '.$id);
});

$router->get('/user/([a-zA-Z]*)', function ($req, $res) {
    $name = $req->getAttribute('args')[1];
    return $res->withText('User by name: '.$name);
});

$router->start();
