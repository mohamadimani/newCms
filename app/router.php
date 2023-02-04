<?php
class Router
{
    private static $_route;

    public static function route($url = '')
    {
        if ($checkRoute = self::checkRoute($url)) {
            $urlArray = explode('.', $checkRoute['action']);
            $controllerName = rtrim($urlArray[0], 'Controller');
            $methodName = 'action_' . (isset($urlArray[1]) ? $urlArray[1] : 'index');
            $params =  $checkRoute['params'];
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
            preg_match_all('/\/{([^}]+)}/U', $url, $matches);
            $params = $matches[1];
        }
        self::$_route[$urlName] = [
            'action' => $action,
            'params' => $params
        ];
    }

    private static function checkRoute($url = '')
    {
        foreach (self::$_route as $urlName => $config) {
            $filterParams = self::removeARbitraryParams($config['params']);
            $paramCount = count($config['params']);
            if ($urlName . '/' === rtrim(substr($url, 0, strlen($urlName . '/')), '/') . '/') {
                $urlParts = explode('/', substr($url, strlen($urlName . '/')));
                if ($paramCount >= count($urlParts)) {
                    foreach ($urlParts as $index => $value) {
                        if ($urlParts[$index]) {
                            $filterParams[$index] = $urlParts[$index];
                        }
                    }
                    $config['params'] = $filterParams;
                    return $config;
                }
            }
        }
    }

    private static function removeARbitraryParams($params)
    {
        foreach ($params as $key => $value) {
            if ($value[0] === '?') {
                return array_slice($params, $key);
            }
        }
        return [];
    }
}

// vd('<pre>', 1, 1);
// vd($url, 1, 1);
// vd(self::$_route, 0, 1);