<?php

namespace App;

use App\View;

class Controller
{

    function __construct()
    {
        // echo 'controller';
    }

    protected  function view($viewUrl, $data = [])
    {
        view::view($viewUrl, $data);
    }
}
