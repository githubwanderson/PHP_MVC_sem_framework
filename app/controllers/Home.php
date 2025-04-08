<?php

namespace app\controllers;

use app\models\entity\User;

class Home
{
    public array $data = [];
    public string $view;
    
    public function index()
    {
        $this->view = 'home.php';
        $this->data = [
            'title' => 'Home'
        ];
    }

    public function edit(array $args)
    {
    }
}