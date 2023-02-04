<?php

class Index
{

    public function action_index(string $name = null, int $age = null): void
    {
        echo 'home page';
    }

    public function action_getname(string $name = null, int $age = null): void
    {
        echo 'HI ' . $name . ' - ' . $age . ' Im in index function';
    }

    public function action_salam(string $name = null, $age = ''): void
    {
        echo 'HI ' . $name . ' Are you ' . $age . ' years old ?';
    }

    public function action_home(string $name = null, int $age = null): void
    {
        echo 'home ';
    }

    public function action_getProducts()
    {
        echo 'products list';
    }

    public function action_getProduct($id = '')
    {
        echo 'product  info';
    }
}
