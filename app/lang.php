<?php

namespace App;

class Lang
{
    public static function get($name = '')
    {
        $lang = LANG . DEFAULTLANG . '.json';
        if (is_readable($lang) and mb_strlen($name)) {
            $langParam = json_decode(file_get_contents($lang));
            return  $langParam->{$name} ? (array) $langParam->{$name} : vd('text not found', 0, 1);
        }
    }
}
