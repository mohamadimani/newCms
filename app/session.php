<?php

namespace App;

class Session
{
    private static $_id;
    public static function init()
    {
        if (!session_start()) {
            session_start();
            self::$_id = session_id();
        }
    }

    public static function set($name = '', $value = '')
    {
        $_SESSION[$name] = $value;
    }

    public static function unSet($name = '')
    {
        unset($_SESSION[$name]);
    }

    public static function get($name = '')
    {
        return isset($_SESSION[$name]) ? $_SESSION[$name] : null;
    }

    public static function all()
    {
        return $_SESSION;
    }

    public static function isset($name = '')
    {
        return isset($_SESSION[$name]) ? true : false;
    }

    public static function clear($name = '')
    {
        session_destroy(self::$_id);
    }
}
