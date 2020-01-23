<?php
use FilippoFinke\Utils\Database;
require __DIR__ . '/../vendor/wautoload.php';

Database::setPassword('password');
Database::setDatabase('db');
$pdo = Database::getConnection();

var_dump($pdo);

?>