<?php

namespace App;

class Input
{
    public static function get($var = '', $default = null)
    {
        if (mb_strlen($var)) {
            return isset($_GET[$var]) ? $_GET[$var] : $default;
        }
        return isset($_GET) ? $_GET : $default;
    }

    public static function post($var = '', $default = null)
    {
        if (mb_strlen($var)) {
            return isset($_POST[$var]) ? $_POST[$var] : $default;
        }
        return isset($_POST) ? $_POST : $default;
    }
}
