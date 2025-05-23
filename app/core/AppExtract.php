<?php

namespace app\core;

use app\interfaces\AppInterface;
use app\core\ControllerExtract;
use app\core\MethodExtract;

class AppExtract implements AppInterface
{
    public array $uri = [];
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
        return ParamExtract::extract($this->sliceIndexStartFrom);
    }
}