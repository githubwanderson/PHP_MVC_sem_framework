<?php

namespace app\core;

class AppExtract
{
    public array $uri = [];
    private string $controller = 'Home';
    private string $method = 'index';

    public function controller()
    {
        $controller = '';
        $this->uri = explode('/', $_SERVER['REQUEST_URI']);
                
        if(!empty($this->uri[1])){
            $controller = ucfirst($this->uri[1]);
        }

        $namespaceAndController = "app\\controllers\\{$controller}";

        if(class_exists($namespaceAndController)){
            $this->controller = $namespaceAndController;
        } else {
            $this->controller = "app\\controllers\\{$this->controller}";
        }

        return $this->controller;
    }

    public function method()
    {
        $method = '';        
        if(!empty($this->uri[2])){
            $method = strtolower($this->uri[2]);
        }

        if(!empty($method) && method_exists($this->controller, $method)){
            $this->method = $method;
        }

        return $this->method;
    }

    public function params()
    {
    }
}