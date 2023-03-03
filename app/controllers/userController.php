<?php

namespace App\controllers;

use App\Controller;
use App\Cookie;
use App\Input;
use App\Lang;
use App\Model;
use App\models\CommentModel;
use App\session;
use App\models\UserModel;
use App\models\LevelModel;
use App\models\MessageModel;
use App\models\NewsGroupsModel;
use App\models\NewsModel;
use App\View;
use DateTime;

class UserController extends Controller
{
    protected static $userModel;
    function __construct()
    {
        session::set('lang', 'fa');
        self::$userModel = new UserModel;
        parent::__construct();
    }

    public function action_index()
    {
        // ----------- user -----------
        // $userModel = new UserModel();
        // $userModel->name = 'mani';
        // $userModel->email = 'mani@yahoo.com';
        // $userModel->username = 'mani0406';
        // $userModel->password = '0406';
        // if ($userModel->save()) {
        //     vd('Saved !', 0, 1);
        // } else {
        //     vd('Not save !', 0, 1);
        // }
        // vd($userModel, 0, 1);


        View::view('user.profile');
    }

    public function action_login()
    {
        $data = [];
        if (session::get('user')) {
            redirect(BASE_URL . 'user');
        }
        if (session::get('errors')) {
            $data['errors'] = session::get('errors');
            session::unSet('errors');
        }
        // vd($data,1,1);
        View::view('user.login', $data);
    }
    public function action_logOut()
    {
        if (session::get('user')) {
            session::unSet('user');
            redirect(BASE_URL . 'login');
        }
    }

    public function action_doLogin()
    {
        if ($post = input::post()) {
            $password = md5($post['password']);
            $userModel =  self::$userModel->find(['username' => $post['username'], 'password' => $password]);
            if ($userModel) {
                session::set('user', $userModel);
                session::set('errors', __('success.wellcome'));
                redirect(BASE_URL . 'user');
            } else {
                session::set('errors', __('errors.userpass_not_currect'));
                redirect(BASE_URL . 'login');
            }
        }
    }

    public function action_register()
    {
        if ($post = input::post()) {
            $userModel = new UserModel();
            $userModel->username = $post['username'];
            $userModel->password = $post['password'];
            $userModel->email = '';
            $userModel->name = '';
            vd($post, 0, 1);
            vd($userModel, 0, 1);
        }
    }

    public function action_ticket()
    {
        $url = 'https://ws.alibaba.ir/api/v2/train/available/eyJPcmlnaW4iOjU0LCJEZXN0aW5hdGlvbiI6MSwiRGVwYXJ0dXJlRGF0ZSI6IjIwMjMtMDItMjVUMDA6MDA6MDAiLCJUaWNrZXRUeXBlIjoxLCJJc0V4Y2x1c2l2ZUNvbXBhcnRtZW50IjpmYWxzZSwiUGFzc2VuZ2VyQ291bnQiOjEsIlJldHVybkRhdGUiOm51bGwsIlNlcnZpY2VUeXBlIjpudWxsLCJDaGFubmVsIjoxLCJBdmFpbGFibGVUYXJnZXRUeXBlIjpudWxsLCJSZXF1ZXN0ZXIiOm51bGwsIlVzZXJJZCI6MCwiT25seVdpdGhIb3RlbCI6ZmFsc2V9';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        $res = json_decode(curl_exec($ch));
        $table = "<table>";
        foreach ($res->result->departing as $row) {
            $time = date('H:i', strtotime($row->departureDateTime));
            if ($time == '08:49') {
                $color = $row->seat > 0 ? 'green' : 'red';
                $table .= "<tr style='color:" . $color . ";font-size:15px;font-weight:bold;padding:15px 0;position:relative;margin:5px 0;display:block;'>";
            } else {
                $table .= "<tr style='color:blue;font-size:15px;font-weight:bold;padding:15px 0;position:relative;margin:5px 0;display:block;'>";
            }

            $table .= "<td> From : " . $row->originName . "  - </td>";
            $table .= "<td> To : " . $row->destinationName . "  -  </td>";
            $table .= "<td> Time : " . $time . "  -  </td>";
            $table .= "<td> Seat : " . $row->seat . " </td>";

            $table .= "</tr>";
        }
        $table .= "</table>";
        vd($table, 0, 1);
    }
}
