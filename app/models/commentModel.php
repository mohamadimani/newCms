<?php

namespace App\models;

use App\Model;

class  CommentModel extends Model
{

    public  function __construct()
    {
        parent::__construct();

        $this->_table = 'comments';
        $this->_fields =
            [
                 'id' => null,
                'body' => null,
                'name' => null,
                'email' => null,
                'news_id' => null,
                'state' => null,
                'create_at' => null,
            ];
    }
}
