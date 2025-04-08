<?php

namespace app\controllers;

use app\models\entity\User as UserModel;
use Exception;

class User
{
    public array $data = [];
    public string $view;

    public function index(){
        $users = (new UserModel)->findAll();

        $this->view = 'user/index.php';
        $this->data = [
            'title' => 'Usuarios',
            'users' => $users
        ];
    }

    public function edit(array $args)
    {
        $user = (new UserModel)->findBy('id',$args[0]);

        if(!$user){
            throw new Exception('Usuário não encontrado');
        }

        $this->view = 'user/edit.php';
        $this->data = [
            'title' => 'Dados do user',
            'user' => $user
        ];
    }
}