<?php

namespace app\core;

use app\interfaces\ControllerInterface;
use app\core\ControllerExtract;
use app\core\MethodExtract;

class AppExtract implements ControllerInterface
{
    public array $uri = [];
    private array $params = [];
    private $sliceIndexStartFrom = 2;

    public function controller() :string
    {   
        return ControllerExtract::extract();
    }

    public function method($controller) :string
    {
        [$method, $sliceIndexStartFrom] = MethodExtract::extract($controller);
        $this->sliceIndexStartFrom = $sliceIndexStartFrom;
        
        return $method;
    }

    public function params() :array
    {
        $countUri = count($this->uri);

        $this->params = array_slice($this->uri,$this->sliceIndexStartFrom,$countUri);

        return $this->params;
    }
}