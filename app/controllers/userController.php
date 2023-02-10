<?php

namespace App\controllers;

use App\Controller;
use App\models\UserModel;

class UserController extends Controller
{

    public function Action_show()
    {
        $data['name'] = 'mani';
        $data['age'] = '31';

        $this->view('user.show', compact('data'));
    }

    public function action_update($name = "")
    {
        $info = $name;
        $this->view('user.update', compact('info'));
    }

    public function action_usersList()
    {
        $data = [
            ['name' => 'mani', 'age' => '30'],
            ['name' => 'ali', 'age' => '24'],
            ['name' => 'reza', 'age' => '22'],
            ['name' => 'hasan', 'age' => '27'],
        ];

        $this->view('user.userslist', compact('data'));
    }
}
