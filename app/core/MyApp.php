<?php

namespace app\core;

use app\interfaces\ControllerInterface;
use Exception;

class MyApp 
{
    private $controllerInterface;
    private $controller;

    public function __construct(ControllerInterface $controllerInterface)
    {
        $this->controllerInterface = $controllerInterface;
    }

    public function controller()
    {
        $controller = $this->controllerInterface->controller();
        $method     = $this->controllerInterface->method($controller);
        $params     = $this->controllerInterface->params();
        
        $this->controller = new $controller;
        $this->controller->$method($params);        
    }

    public function view()
    {
        if($_SERVER['REQUEST_METHOD'] === 'GET'){

            if(empty($this->controller->data)){
                throw new Exception('A propriedade $data é obrigatório');
            }
        
            if(!array_key_exists('title', $this->controller->data)){
                throw new Exception('A propriedade title é obrigatória');
            }
        
            extract($this->controller->data);
            require '../app/views/index.php';
        }
    }
}