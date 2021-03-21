<?php

namespace app\api\controller\v2;

use app\api\model\User as UserModel;

class User {//http://tp5.com:8080/v2/user/10

// 获取用户信息
    public function read($id = 0) {
        $user = UserModel::get($id, 'profile');
        if ($user) {
            return json($user);
        } else {
            return json(['error' => '用户不存在'], 404);
        }
    }

}
