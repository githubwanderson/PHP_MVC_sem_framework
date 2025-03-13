<?php

namespace app\core;

class MethodExtract
{
    public static function extract($controller)
    {
        $uri = Uri::uri();
        $sliceIndexStartFrom = 1;

        if(!empty($uri[1])){
            $method = strtolower($uri[1]);
        }

        if(!empty($uri[1])){
            $sliceIndexStartFrom = 2;
            $method = strtolower($uri[1]);
            if(method_exists($controller, $method)){
                return [
                    $method,
                    $sliceIndexStartFrom
                ];
            }
        }

        return [
            'index',
            $sliceIndexStartFrom
        ];
    }
}