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

    public function action_salam(string $name = null, int $age = null): void
    {
        echo 'HI '  ;
    }
    public function action_home(string $name = null, int $age = null): void
    {
        echo 'home '  ;
    }

}
