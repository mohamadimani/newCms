<?php

namespace App\models;

use App\Model;

class  NewsModel extends Model
{

    public  function __construct()
    {
        parent::__construct();

        $this->_table = 'news';
        $this->_fields =
            [
                'id' => null,
                'group_id' => null,
                'title' => null,
                'body' => null,
                'user_id' => null,
                'views' => null,
                'state' => null,
                'create_at' => null,
                'update_at' => null,
            ];
    }
}
