<?php

use App\Router;

// Router::get('select', 'userController.select');
rGet('/', 'userController.index');
rGet('login', 'userController.login');
rGet('ticket', 'userController.ticket');
// rPost('/', 'userController.form');
// rGet('select', 'userController.select');
// rPost('select', 'userController.select');

rGet('news', 'newsController.index');
rGet('message', 'messageController.index');
rGet('news', 'newsController.index');
