<?php
// var_dump(isset($_GET['url']));
// die();

$url = isset($_GET['url']) ? mb_strtolower($_GET['url']) : 'index/index';
$url = explode('/', $url);
$controllerName = isset($url[0]) ? $url[0] : 'index';
$methodName = 'action_' . (isset($url[1]) ? $url[1] : 'index');
$params = count($url) > 2 ? array_slice($url,2) : [];
$controller = 'controllers/' . $controllerName  .  'Controller.php';

if (!file_exists($controller)) {
    die('Controller not exist!');
}
require_once($controller);

if (!class_exists($controllerName)) {
    die('Class not exist!');
}

$controllerObject = new $controllerName;

if (!method_exists($controllerObject, $methodName)) {
    die('Function not exist!');
}

print_r($params);
call_user_func_array([$controllerObject , $methodName], $params);

print_r($controllerName);
echo '<br> ----- <br>';
print_r($methodName);
echo '<br> ----- <br>';
