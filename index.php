<?php
require('app/router.php');
require('config/routes.php');

function vd($param, $notDie = true, $printR = false)
{
    if ($printR) {
        print_r($param);
    } else {
        var_dump($param);
    }
    if ($notDie) {
        echo '</br>';
    } else {
        die('</br>');
    }
}

$url = isset($_GET['url']) ? mb_strtolower($_GET['url']) : '/';
Router::route($url);
