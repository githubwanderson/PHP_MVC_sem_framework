<?php

use app\core\AppExtract;

session_start();

require '../vendor/autoload.php';

$app = new AppExtract;

$controller = $app->controller();
$method = $app->method();
$params = $app->params();

$controller = new $controller;
$controller->$method($params);

if($_SERVER['REQUEST_METHOD'] === 'GET'){
    extract($controller->data);
    require '../app/views/index.php';
}

// var_dump($controller);
// var_dump($method);
// var_dump($params);