<?php

namespace app\controllers;

use app\models\entity\User;

class Home
{
    public array $data = [];
    public string $view;
    
    public function index()
    {
        $users = (new User)->findAll();

        $this->view = 'home.php';
        $this->data = [
            'title' => 'Home',
            'users' => $users
        ];
    }

    public function edit(array $args)
    {
    }
}