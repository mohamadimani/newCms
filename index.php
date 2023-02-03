<?php
require('app/router.php');
require('config/routes.php');

function vd($param, $die = true, $printR = false)
{
    if ($printR) {
        print_r($param);
    } else {
        var_dump($param);
    }
    if ($die) {
        die('</br>');
    } else {
        echo '</br>';
    }
}

$url = isset($_GET['url']) ? mb_strtolower($_GET['url']) : '/';
Router::route($url);
