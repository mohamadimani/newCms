<?php

namespace App;

class View
{

    public static function view($view, $data = [])
    {
        $viewPath = str_replace('.', DIR_SEPRATOR, $view) . VIEW_EXTENTION;
        $loader = new \Twig\Loader\FilesystemLoader(VIEW_URL);
        $twig = new \Twig\Environment($loader);
        echo $twig->render($viewPath, $data);
    }
}
