<?php

namespace app\core;

class Uri
{
    public static function uri() : array {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);        
        return explode('/', ltrim($uri, '/'));
    }
}