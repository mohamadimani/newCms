<?php
Router::setRoute('/', 'indexController.index');
Router::setRoute('salam/{name}/{?age}/{date}', 'indexController.salam');
Router::setRoute('products/{id}', 'indexController.getProducts');
