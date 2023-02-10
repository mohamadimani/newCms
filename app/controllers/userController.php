<?php

namespace App\controllers;

use App\Controller;
use App\models\UserModel;

class UserController extends Controller
{

    public function Action_show()
    {
        $model = new UserModel();
    }
}
