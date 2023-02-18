<?php

namespace App;

class Cookie
{
    public static function set($name = '', $value = '', $cookieTime = 600)
    {
        setcookie($name, $value, time() + $cookieTime);
    }

    public static function unSet($name = '')
    {
        setcookie($name, '', time() + 1);
    }

    public static function get($name = '')
    {
        return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
    }

    public static function isset($name = '')
    {
        return isset($_COOKIE[$name]) ? true : false;
    }
}
