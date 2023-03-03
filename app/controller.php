<?php

namespace App;

use App\View;

class Controller
{
    function __construct()
    {
    }

    protected  function view($viewUrl, $data = [])
    {
        view::view($viewUrl, $data);
    }
}
