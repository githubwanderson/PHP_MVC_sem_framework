<?php

namespace app\core;

use app\interfaces\AppInterface;
use Exception;

class MyApp 
{
    private $appInterface;
    private $controller;

    public function __construct(AppInterface $appInterface)
    {
        $this->appInterface = $appInterface;
    }

    public function controller()
    {
        $controller = $this->appInterface->controller();
        $method     = $this->appInterface->method($controller);
        $params     = $this->appInterface->params();
        
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