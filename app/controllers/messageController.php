<?php

namespace App\controllers;

use App\Controller;
use App\Cookie;
use App\Input;
use App\Lang;
use App\models\CommentModel;
use App\session;
use App\models\UserModel;
use App\models\LevelModel;
use App\models\MessageModel;
use App\models\NewsGroupsModel;
use App\models\NewsModel;
use App\View;
use DateTime;

class MessageController extends Controller
{



    public function action_index()
    {
        // // ----------- message -----------
        $userModel = new MessageModel();
        $userModel->from = 1;
        $userModel->to = 2;
        $userModel->title = 'message12312';
        $userModel->body = 'maniasdasd ';
        $userModel->create_at = '2015-12-18 00:00:02';
        if ($userModel->save()) {
            vd('Saved !', 0, 1);
        } else {
            vd('Not save !', 0, 1);
        }

        vd($userModel, 0, 1);

    }


}
