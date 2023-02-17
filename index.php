<?php

use App\BootStrap;

require('app/bootstrap.php');
require('vendor/autoload.php');
require('config/config.php');
require('app/helper.php');
require('app/router.php');
require('config/routes.php');

$bootStrap = new BootStrap();
$bootStrap->run();

