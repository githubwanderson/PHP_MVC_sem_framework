<?php

namespace app\core;

class MethodExtract
{
    public static function extract($controller)
    {
        $method = 'index';
        $uri = Uri::uri();
        $sliceIndexStartFrom = 2;

        if(!empty($uri[1])){
            $method = strtolower($uri[1]);
        }

        if(!empty($method) && method_exists($controller, $method)){
            $method = $method;
            $sliceIndexStartFrom = 1;
        }

        return [
            $method,
            $sliceIndexStartFrom
        ];
    }
}