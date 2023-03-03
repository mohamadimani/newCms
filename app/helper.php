<?php

use App\Router;
use App\Input;
use App\Session;

function vd($param, $notDie = false, $printR = false)
{
    print_r('<pre>');
    if ($printR) {
        print_r($param);
    } else {
        var_dump($param);
    }
    if ($notDie) {
        echo '</br>';
    } else {
        die('</br>');
    }
}

function __($name = '')
{
    $lang = Session::isset('lang')  ? Session::get('lang') : DEFAULTLANG;
    $langFile = LANG . $lang . '.json';
    if (mb_strlen($name)) {
        $name = explode('.', $name);
    }
    if (is_readable($langFile)) {
        $langParam = json_decode(file_get_contents($langFile));
        if (isset($langParam->{$name[0]}) and $firstPart = $langParam->{$name[0]} and isset($firstPart->{$name[1]})) {
            return $firstPart->{$name[1]};
        } else {
            vd('text not found', 0, 1);
        }
    }
}

function setQuestionMarkForQuery($fields = [])
{
    $fieldsKey = '';
    $count = 0;
    foreach ($fields as $key => $value) {
        $count++;
        $fieldsKey .= (count($fields) > $count) ? '?,' : '?';
    }
    return $fieldsKey;
}

function setQuteForFields($fields = [], $mark = ',', $lastMark = '')
{
    $fieldsKey = '';
    $count = 0;
    foreach ($fields as $key => $value) {
        $count++;
        $fieldsKey .= (count($fields) > $count) ? '`' . $key . '`' . $mark : '`' . $key . '`' . $lastMark;
    }
    return $fieldsKey;
}

function rGet($url = '', $function = '')
{
    Router::get($url, $function);
}

function rPost($url = '', $function = '')
{
    Router::post($url, $function);
}

function redirect($url = '')
{
    header('location:' . $url);
}
