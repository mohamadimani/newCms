<?php
Router::setRoute('/', 'indexController.hi');
Router::setRoute('salam', 'indexController.hi', ['method' => 'GET']);
Router::setRoute('salam', 'indexController.by', ['method' => 'POST']);

// Router::setRoute('/', 'indexController.index');
// Router::setRoute('salam/{name}/{?age}/{?date}', 'indexController.salam');
// Router::setRoute('products/{id}', 'indexController.getProducts');
// Router::setRoute('hi/{?name}', 'indexController.hi', ['method' => 'GET']);
// Router::setRoute('hi/{?name}', 'indexController.by', ['method' => 'POST']);
