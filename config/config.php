<?php

define('DIR_SEPRATOR',  DIRECTORY_SEPARATOR);
define('PROJECT_NAME',  'newCms');
define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . DIR_SEPRATOR . PROJECT_NAME . DIR_SEPRATOR);
define('BASE_PATH', dirname(dirname(__FILE__)) . DIR_SEPRATOR);
define('VIEW_URL', BASE_PATH . 'views' . DIR_SEPRATOR);
define('PUBLIC_URL', BASE_PATH . 'public' . DIR_SEPRATOR);
define('VIEW_EXTENTION', '.twig');
define('MAIN_VIEW', VIEW_URL . 'masterpage' . VIEW_EXTENTION);
define('LANG', BASE_PATH . 'config' . DIR_SEPRATOR . 'lang' . DIR_SEPRATOR);
define('DEFAULTLANG', 'en');
define('UPLOAD_URL', PUBLIC_URL . 'upload' . DIR_SEPRATOR);
define('DATE_TIMEZONE', 'Asia/Tehran');
