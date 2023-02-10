<?php

namespace App;

use Exception;

class View
{

    public static function view($view, $data = [])
    {
        $viewPath = str_replace('.', DIR_SEPRATOR, $view);
        $path =  VIEW_URL . $viewPath . VIEW_EXTENTION;
        if (is_readable($path)) {
            foreach ($data as $key => $value) {
                ${$key} = $value;
            }
            include $path;
        } else {
            throw new Exception('view path in not readable');
        }
    }
}
