<?php

namespace app\core;

class ControllerExtract
{
    public static function extract()
    {
        $controller = 'Home';
        $uri = Uri::uri();
                
        if(!empty($uri[0])){
            $controller = ucfirst($uri[0]);
        }

        $namespaceAndController = "app\\controllers\\{$controller}";

        if(class_exists($namespaceAndController)){
            $controller = $namespaceAndController;
        } else {
            $controller = "app\\controllers\\{$controller}";
        }

        return $controller;
    }
}