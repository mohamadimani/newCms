<?php
// Router::setRoute('/', 'indexController.index');
Router::setRoute('/', 'userController.show');
Router::setRoute('update/{name}', 'userController.update');
Router::setRoute('userslist', 'userController.usersList');

