<?php

namespace App\models;

use App\Model;

class  UserModel extends Model
{

    public  function __construct()
    {
        parent::__construct();

        $this->_table = 'users';
        $this->_fields =
            [
                'id' => null,
                'name' => null,
                'username' => null,
                'password' => null,
                'email' => null,
                'level_id' => null,
                'state' => null,
                'rememberme' => null,
                'question' => null,
            ];
    }
}
