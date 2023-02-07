<?php

class Index
{

    public function action_index(string $name = null, int $age = null): void
    {
        echo 'home page index';
    }

    public function action_hi($id = '')
    {
        echo 'Hi ' . $id;
    }

    public function action_by($id = '')
    {
        echo 'By ' . $id;
    }
}
