<?php

namespace App;

class Env
{

    private static $_config;
    public static function getDbEnv($name)
    {
        if (!self::$_config['database']) {
            self::$_config = json_decode(file_get_contents(BASE_URL . '.env'), true);
        }
        return  isset(self::$_config['database'][$name]) ? self::$_config['database'][$name] : null;
    }
}
