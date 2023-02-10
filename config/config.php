<?php

define('DIR_SEPRATOR',  DIRECTORY_SEPARATOR);
define('BASE_URL', dirname(dirname(__FILE__)) . DIR_SEPRATOR);
define('VIEW_URL', BASE_URL . 'views' . DIR_SEPRATOR);
define('VIEW_EXTENTION', '.php');
define('MAIN_VIEW', VIEW_URL . 'index' . VIEW_EXTENTION);
