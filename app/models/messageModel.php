<?php

namespace App\models;

use App\Model;

class  MessageModel extends Model
{

    public  function __construct()
    {
        parent::__construct();

        $this->_table = 'messages';
        $this->_fields =
            [
                'id' => null,
                'from' => null,
                'to' => null,
                'title' => null,
                'body' => null,
                'create_at' => null,
            ];
    }
}
