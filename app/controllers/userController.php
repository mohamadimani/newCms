<?php

namespace App\controllers;

use App\Controller;
use App\Lang;
use App\session;
use App\models\UserModel;

class UserController extends Controller
{

    public function Action_saveTest()
    {
        $userModel = new UserModel;
        $userModel->id = 1;
        $userModel->username = str_shuffle('abdeflxvz');
        $userModel->password = str_shuffle('abcdefghijklmnopqrs23456789');
        if ($userModel->save()) {
            vd('ok', 0, 1);
        } else {
            vd('nok', 0, 1);
        }
    }

    public function Action_deleteTest($id = 0)
    {
        $userModel = new UserModel;
        $userModel->id = $id;
        if ($userModel->delete()) {
            vd('ok', 0, 1);
        } else {
            vd('nok', 0, 1);
        }
    }

    public function action_select()
    {
        // vd(__('errors.field_not_found'), 0, 1);
        $userModel = new UserModel;
        $user = $userModel->findById(18);
        foreach ($user as $model) {
            $model->username = 'ali';
            $model->save();
        }
        vd($model, 0, 1);
        // $users = $userModel->findByUserName('mani');
        // $find = $userModel->find(['username' => 'mani', 'password' => '123'], 'OR');
    }

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
