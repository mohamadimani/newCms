<?php
class Router
{
    private static $_route;

    public static function route($url = '')
    {
        if (isset(self::$_route[$url])) {
            $urlArray = explode('.', self::$_route[$url]);
            $controllerName = rtrim($urlArray[0], 'Controller');
            $methodName = 'action_' . (isset($urlArray[1]) ? $urlArray[1] : 'index');
            $params =  [];
            $controller = 'controllers/' .  $controllerName  .  'Controller.php';
            if (!file_exists($controller)) {
                die('Controller ' . rtrim($controllerName, 'Controller') . ' not exist!');
            }
            require_once($controller);
            if (!class_exists($controllerName)) {
                die('Class ' . $controllerName . ' not exist!');
            }
            $controllerObject = new $controllerName;
            if (!method_exists($controllerObject, $methodName)) {
                die('Function ' . $methodName . ' not exist!');
            }
            call_user_func_array([$controllerObject, $methodName], $params);
        } else {
            self::baseRout($url);
        }
    }


    public static function baseRout($url = '')
    {
        $url = explode('/', $url);
        $controllerName = isset($url[0]) ? $url[0] : 'index';
        $methodName = 'action_' . (isset($url[1]) ? $url[1] : 'index');
        $params = count($url) > 2 ? array_slice($url, 2) : [];
        $controller = 'controllers/' . rtrim($controllerName, 'Controller')  .  'Controller.php';
        if (!file_exists($controller)) {
            die('Controller ' . rtrim($controllerName, 'Controller') . ' not exist!');
        }
        require_once($controller);
        if (!class_exists($controllerName)) {
            die('Class ' . $controllerName . ' not exist!');
        }
        $controllerObject = new $controllerName;
        if (!method_exists($controllerObject, $methodName)) {
            die('Function ' . $methodName . ' not exist!');
        }
        call_user_func_array([$controllerObject, $methodName], $params);
    }

    public static function setRoute($url = '', $action = '')
    {
        preg_match_all('/^([^{]+)\//', $url, $matches);
        $params = [];
        $urlName = isset($matches[1][0]) ? $matches[1][0] : $url;
        if ($url !== $urlName) {
            preg_match_all('/\/{([^}]+)]/U', $url, $matches);
            $params = $matches[1];
        }
        self::$_route[$urlName] = [
            'action' => $action,
            'params' => $params
        ];
    }

    public static function checkRoute($url = '')
    {
    }
}
