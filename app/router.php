<?php
class Router
{
    private static $_route = [];
    private static $_defaultConfig = [
        'method' => 'GET'
    ];

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
            die('base Controller ' . rtrim($controllerName, 'Controller') . ' not exist!');
        }
        require_once($controller);
        if (!class_exists($controllerName)) {
            die('base Class ' . $controllerName . ' not exist!');
        }
        $controllerObject = new $controllerName;
        if (!method_exists($controllerObject, $methodName)) {
            die('base Function ' . $methodName . ' not exist!');
        }
        call_user_func_array([$controllerObject, $methodName], $params);
    }

    public static function setRoute($url = '', $action = '', $config = [])
    {
        $config = self::setConfig($config);
        preg_match_all('/^([^{]+)\//', $url, $matches);
        $params = [];
        $urlName = isset($matches[1][0]) ? $matches[1][0] : $url;
        if ($url !== $urlName) {
            preg_match_all('/\/{([^}]+)}/U', $url, $matches);
            $params = $matches[1];
        }
        self::$_route[] = [
            'action' => $action,
            'params' => $params,
            'method' => $config['method'],
            'name' => $urlName,
        ];
    }

    private static function checkRoute($url = '')
    {
        $requestType = $_SERVER['REQUEST_METHOD'];
        foreach (self::$_route as $urlName => $config) {
            $urlName = $config['name'];
            $filterParams = self::removeARbitraryParams($config['params']);
            $paramCount = count($config['params']);
            $urlMake = rtrim(substr($url, 0, strlen($urlName)), '/');

            if ($urlName === $urlMake or $urlName == '/') {
                $urlParts = explode('/', $urlMake);
                if ($paramCount >= count($urlParts) and $requestType == $config['method']) {
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

    private static function setConfig($config = [])
    {
        $ret = self::$_defaultConfig;
        foreach ($config as $key => $value) {
            $ret[$key] = $value;
        }
        return $ret;
    }
}

// vd('<pre>', 1, 1);
// vd($url, 1, 1);
// vd(self::$_route, 0, 1);