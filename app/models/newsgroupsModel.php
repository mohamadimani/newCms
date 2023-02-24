<?php

namespace App\models;

use App\Model;

class  NewsGroupsModel extends Model
{

    public  function __construct()
    {
        parent::__construct();

        $this->_table = 'newsgroups';
        $this->_fields =
            [
                'id' => null,
                'name' => null,
            ];
    }
}
