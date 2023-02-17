<?php

namespace App;

use App\Router;

class BootStrap
{
    public function __construct()
    {
        Session::init();
    }
    public function run()
    {
        $url = (Input::get('url') && mb_strlen(Input::get('url'))) ? mb_strtolower(Input::get('url')) : '/';
        Router::route($url);
    }
}
