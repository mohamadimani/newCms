<?php

namespace App\controllers;

use App\Controller;
use App\Cookie;
use App\Input;
use App\Lang;
use App\session;
use App\models\UserModel;
use App\View;

class UserController extends Controller
{

    public function action_form()
    {
        // if (!Cookie::get('name')) {
        // Cookie::set('name', 'mani', 100);
        // }
        // Cookie::unset('name');
        // if (Input::post()) { 
        //     input::saveFile('file' , 'image');
        //     vd(Input::post(), 0, 1);
        // }
        View::view('user.profile');
    }

    public function action_index()
    {
        View::view('index.index');
    }
    
    public function action_login()
    {
        View::view('user.login');
    }
}
