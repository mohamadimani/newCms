<?php

namespace App;

class Lang
{
    public static function get($name = '')
    {
        $lang = session::isset('lang')  ? session::get('lang') : DEFAULTLANG;
        $langFile = LANG . $lang . '.json';
        if (is_readable($langFile) and mb_strlen($name)) {
            $langParam = json_decode(file_get_contents($langFile));
            return  $langParam->{$name} ? (array) $langParam->{$name} : vd('text not found', 0, 1);
        }
    }
}
