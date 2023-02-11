<?php

namespace App\models;

use App\Model;

class UserModel extends Model
{

    public  function __construct()
    {
        parent::__construct();

        $this->_table = 'users';
        $this->_fields =
            [
                'username' => null,
                'password' => null,
                // 'email' => null,
                // 'mobile' => null
            ];
    }
}
