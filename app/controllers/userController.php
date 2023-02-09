<?php

namespace App\controllers;

use App\Controller;
use App\Models\User;

class UserController extends Controller
{

    public function Action_show()
    {
        $model = new User();
    }
}
