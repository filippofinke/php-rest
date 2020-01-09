<?php
use FilippoFinke\Router;

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/home.php';


$router = new Router();

$router->get('/', 'Home::index');
$router->get('/dashboard', 'Home::dashboard');


$router->start();
