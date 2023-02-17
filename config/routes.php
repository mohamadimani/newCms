<?php

use App\Router;
// Router::setRoute('/', 'indexController.index');
// Router::setRoute('/', 'userController.show');
// Router::setRoute('update/{name}', 'userController.update');
// Router::setRoute('userslist', 'userController.usersList');
// Router::setRoute('save', 'userController.saveTest');
// Router::setRoute('delete/{id}', 'userController.deleteTest');
// Router::setRoute('select', 'userController.select');


// Router::get('select', 'userController.select');
rGet('/', 'userController.form');
rPost('/', 'userController.form');
rGet('select', 'userController.select');
rPost('select', 'userController.select');
