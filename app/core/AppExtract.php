<?php

namespace app\core;

use app\interfaces\ControllerInterface;
use app\core\ControllerExtract;

class AppExtract implements ControllerInterface
{
    public array $uri = [];
    private string $controller = 'Home';
    private string $method = 'index';
    private array $params = [];
    private int $sliceIndexStartFrom = 2;

    public function controller() :string
    {   
        return ControllerExtract::extract();
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