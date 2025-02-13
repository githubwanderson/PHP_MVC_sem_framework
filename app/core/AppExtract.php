<?php

namespace app\core;

class AppExtract
{
    public array $uri = [];
    private string $controller = 'Home';

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
    }

    public function params()
    {
    }
}