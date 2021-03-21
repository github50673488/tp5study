<?php

namespace app\index\controller;

use app\index\model\User;
use think\Controller;
use think\Request;
use think\Session;

class Base extends Controller {

    public function _initialize() {
       // $user = User::get(Session::get('user_id'));
        //$user=5;
        //Request::instance()->bind('user', $user);
    }

}
