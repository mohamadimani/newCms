<?php

use App\Router;

rGet('login', 'userController.login');
rPost('login', 'userController.doLogin');

rGet('logout', 'userController.logOut');

rGet('user', 'userController.index');


// Router::get('select', 'userController.select');
// rPost('/', 'userController.form');
// rGet('select', 'userController.select');
// rPost('select', 'userController.select');

rGet('news', 'newsController.index');
rGet('ticket', 'userController.ticket');
rGet('message', 'messageController.index');
rGet('news', 'newsController.index');
