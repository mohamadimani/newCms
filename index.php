<?php
require('config/config.php');
require('app/helper.php');
require('app/router.php');
require('config/routes.php');

$url = (isset($_GET['url']) and  !empty(trim($_GET['url']))) ? mb_strtolower($_GET['url']) : '/';
Router::route($url);
