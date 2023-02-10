<?php
class Router
{
    private static $_route = [];
    private static $_defaultConfig = [
        'method' => 'GET'
    ];

    public static function route($url = '')
    {
        $checkRoute = self::checkRoute($url);
        if (is_callable($checkRoute['action'])) {
            call_user_func_array($checkRoute['action'], $checkRoute['params']);
            $checkRoute['action']();
        } else if ($checkRoute) {
            $urlArray = explode('.', $checkRoute['action']);
            $controllerName =  str_replace('Controller', '', $urlArray[0]);
            $methodName = 'action_' . (isset($urlArray[1]) ? $urlArray[1] : 'index');
            $params =  $checkRoute['params'];
            $controllerClassName = 'App' . DIR_SEPRATOR . 'Controllers' . DIR_SEPRATOR .  ucfirst($controllerName) . 'Controller';
            $controllerObject = new $controllerClassName;
            if (!method_exists($controllerObject, $methodName)) {
                die('Function ' . $methodName . ' not exist!');
            }
            call_user_func_array([$controllerObject, $methodName], $params);
        } else {
            vd('404! page not found', 0, 1);
        }
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
        foreach (self::$_route as $key => $config) {
            $urlName = $config['name'];
            $filterParams = self::removeARbitraryParams($config['params']);
            $urlMake = rtrim(substr($url, 0, strlen($urlName . '/')), '/');
            if ($urlName === (!empty(trim($urlMake)) ? $urlMake : '/')) {
                if ($_SERVER['REQUEST_METHOD'] == $config['method']) {
                    $urlParts = explode('/', trim(substr($url, strlen($urlName)), '/'));
                    $urlParts = array_filter($urlParts);
                    if (count($config['params']) >= count($urlParts)) {
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
        return false;
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
