<?php

namespace app\core;

class ControllerExtract
{
    public static function extract()
    {
        $uri = Uri::uri();
                
        if(!empty($uri[0])){
            $namespaceAndController = "app\\controllers\\" . ucfirst($uri[0]);
            
            if(class_exists($namespaceAndController)){
                return $namespaceAndController;
            }
        }

        return "app\\controllers\\Home";
    }
}