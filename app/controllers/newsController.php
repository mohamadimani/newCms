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

class NewsController extends Controller
{



    public function action_index()
    {
        // ----------- NewsModel -----------
        $userModel = new NewsModel();
        $userModel->group_id = 1;
        $userModel->title = 'mani news';
        $userModel->body = 'mani body';
        $userModel->user_id = 1;
        $userModel->views = 1;
        $userModel->state = 1;
        $userModel->create_at = time();
        if ($userModel->save()) {
            vd('Saved news!', 0, 1);
        } else {
            vd('Not save news!', 0, 1);
        }

        vd($userModel, 0, 1);

    }


}
