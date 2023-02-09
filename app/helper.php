<?php
function vd($param, $notDie = true, $printR = false)
{
    if ($printR) {
        print_r('<pre>');
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

function autoload($className)
{
    $path = BASE_URL . str_replace('/', '\\', $className) . '.php';
    if (is_readable($path)) {
        require_once $path;
    } else {
       throw new Exception('Path Error : ' . $path);
    }
}

spl_autoload_register('autoload');
