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
        $url = (isset($_GET['url']) and  !empty(trim($_GET['url']))) ? mb_strtolower($_GET['url']) : '/';
        Router::route($url);
    }
}
