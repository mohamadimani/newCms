<?php

namespace App\controllers;

use App\Controller;
use App\Input;
use App\Lang;
use App\session;
use App\models\UserModel;
use App\View;

class UserController extends Controller
{

    public function action_form()
    {
        if (Input::post()) {
            vd(Input::post(), 0, 1);
        }
        View::view('user.form');
    }
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
        $userModel = new UserModel;
        $user = $userModel->findById(18);
        foreach ($user as $model) {
            $model->username = 'ali';
            $model->save();
        }
        vd($model, 0, 1);
    }

    public function Action_show()
    {
        $data['name'] = 'mani';
        $data['age'] = '31';

        $this->view('user.show', compact('data'));
    }
}
