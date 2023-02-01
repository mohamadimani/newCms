<?php

$url = checkIssetEndEmpty($_GET['url']) ? mb_strtolower($_GET['url']) : 'index/index';
$url = explode('/', $url);
$controllerName = checkIssetEndEmpty($url[0]) ? $url[0] : 'index';
$methodName = checkIssetEndEmpty($url[1]) ? $url[1] : 'index';

$controller = 'controllers/' . $controllerName  .  '.php';

// var_dump($controller);
if (!file_exists($controller)) {
    die('controller not exist!');
}

require_once($controllerName);

if (!class_exists($controllerName)) {
    die('class not exist!');
}


print_r($controllerName);
echo '<br> ----- <br>';
print_r($methodName);
echo '<br> ----- <br>';












function checkIssetEndEmpty($param = '')
{
    return (isset($param) and !empty(trim($param))) ? true : false;
}
