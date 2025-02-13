<?php

namespace app\core;

class AppExtract
{
    public array $uri = [];
    private string $controller = 'Home';
    private string $method = 'index';
    private array $params = [];
    private int $sliceIndexStartFrom = 2;

    public function controller() :string
    {
        $controller = '';
        $this->uri = explode('/', ltrim($_SERVER['REQUEST_URI'], '/'));
                
        if(!empty($this->uri[0])){
            $controller = ucfirst($this->uri[0]);
        }

        $namespaceAndController = "app\\controllers\\{$controller}";

        if(class_exists($namespaceAndController)){
            $this->controller = $namespaceAndController;
        } else {
            $this->controller = "app\\controllers\\{$this->controller}";
        }

        return $this->controller;
    }

    public function method() :string
    {
        $method = '';        
        if(!empty($this->uri[1])){
            $method = strtolower($this->uri[1]);
        }

        if(!empty($method) && method_exists($this->controller, $method)){
            return $this->method = $method;
        }

        $this->sliceIndexStartFrom = 1;
        return $this->method;
    }

    public function params() :array
    {
        $countUri = count($this->uri);

        $this->params = array_slice($this->uri,$this->sliceIndexStartFrom,$countUri);

        return $this->params;
    }
}