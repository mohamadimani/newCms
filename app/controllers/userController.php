<?php

namespace App\controllers;

use App\Controller;
use App\models\UserModel;

class UserController extends Controller
{

    public function Action_show()
    {
        $data['name'] = 'mani';
        $data['age'] = '30';

        $this->view(
            'user.show',
            $data
        );
    }

    public function action_update($name = "")
    {
        $data['info'] = $name;
        $this->view('user.update', $data);
    }
}
