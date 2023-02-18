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

    public static function file($var = '', $default = null)
    {
        if (mb_strlen($var)) {
            return isset($_FILES[$var]) ? $_FILES[$var] : $default;
        }
        return isset($_FILES) ? $_FILES : $default;
    }

    public static function saveFile($fileName = '', $path = '')
    {
        if ($file = input::file($fileName)) {
            $url = UPLOAD_URL . $path;
            if (!is_dir($url)) {
                mkdir($url);
            }
            $url = $url . (mb_strlen($path) ? DIR_SEPRATOR : '') . $file['name'];
            move_uploaded_file($file['tmp_name'], $url);
            return true;
        }
        vd(__('errors.file_not_uploded'), 0, 1);
    }
}
