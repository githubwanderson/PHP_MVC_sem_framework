<?php

use app\core\AppExtract;

session_start();

require '../vendor/autoload.php';

try {

    $app = new AppExtract;

    $controller = $app->controller();
    $method = $app->method();
    $params = $app->params();

    $controller = new $controller;
    $controller->$method($params);

    if($_SERVER['REQUEST_METHOD'] === 'GET'){

        if(empty($controller->data)){
            throw new Exception('A propriedade $data é obrigatório');
        }

        if(!array_key_exists('title', $controller->data)){
            throw new Exception('A propriedade title é obrigatória');
        }

        extract($controller->data);
        require '../app/views/index.php';
    }
} catch (Throwable $th) {
    formatException($th);
}