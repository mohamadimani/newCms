<?php

namespace App\models;

use App\Model;

class  LevelModel extends Model
{

    public  function __construct()
    {
        parent::__construct();

        $this->_table = 'levels';
        $this->_fields =
            [
                'id' => null,
                'name' => null,
                'rule' => null,
            ];
    }
}
