<?php

namespace app\controllers;

use app\helpers\inputHelper;

class Login
{
    public array $data = [];
    public string $view;

    public function index()
    {
        $this->view = 'login.php';
        $this->data = [
            'title' => 'Login'
        ];
    }

    public function store()
    {
        $email = inputHelper::filterCustum(INPUT_POST, 'email', 'email');
        $password = inputHelper::filterCustum(INPUT_POST, 'password', 'password');

        var_dump($email,$password); die;

    }
}