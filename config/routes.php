<?php
Router::setRoute('/', 'indexController.index');
Router::setRoute('salam{name}', 'indexController.salam');
Router::setRoute('home', 'indexController.home');
