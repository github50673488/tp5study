<?php

namespace app\index\controller;

use app\index\model\User as UserModel;
use think\Controller;
use think\Validate;
class User extends Controller{

    public function index() {// 获取用户数据列表并输出
        //http://tp5.com:8080/user/index
        //$list = UserModel::all();
        //$list = UserModel::all(['status'=>1]);
//        $list = UserModel::where('id', '>', 5)->select();
//        foreach ($list as $user) {
//            echo $user->nickname . '<br/>';
//            echo $user->email . '<br/>';
//            echo date('Y/m/d', $user->birthday) . '<br/>';
//            echo '----------------------------------<br/>';
//        }
   
        $list = UserModel::all();
        $this->assign('list', $list);
        $this->assign('count', count($list));
        return $this->fetch('list');//application/index/view/user/list.html
        //return $this->fetch('index/list');//application/index/view/index/list.html
        
        
//        // 分页输出列表 每页显示3条数据
//$list = UserModel::paginate(3);
//$this->assign('list',$list);
//return $this->fetch();
    }

// 新增用户数据
    public function add() {//http://tp5.com:8080/user/add
//        $user = new UserModel;
//        $user->nickname = '流年';
//        $user->email = 'thinkphp@qq.com';
//        $user->birthday = strtotime('1977-03-05');
//        if ($user->save()) {
//            return '用户[ ' . $user->nickname . ':' . $user->id . ' ]新增成功';
//        } else {
//            return $user->getError();
//        }
//        $user['nickname'] = '看云';
//        $user['email'] = 'kancloud@qq.com';
//        $user['birthday'] = strtotime('2015-04-02');
//        if ($result = UserModel::create($user)) {
//            return '用户[ ' . $result->nickname . ':' . $result->id . ' ]新增成功';
//        } else {
//            return '新增出错';
//        }
//        $user = new UserModel;
//        if ($user->allowField(true)->save(input('post.'))) {
//            return '用户[ ' . $user->nickname . ':' . $user->id . ' ]新增成功';
//        } else {
//            return $user->getError();
//        }
        
        
//        $user = new UserModel;
//        if ($user->allowField(true)->validate(true)->save(input('post.'))) {
//            return '用户[ ' . $user->nickname . ':' . $user->id . ' ]新增成功';
//        } else {
//            return $user->getError();
//        }
        
        
        
        $data = input('post.');
// 数据验证
//        $result = $this->validate($data, 'User');
//        if (true !== $result) {
//            return $result;
//        }
        
        // 验证birthday是否有效的日期
        $check = Validate::is($data['birthday'], 'date');
        if (false === $check) {
            return 'birthday日期格式非法';
        }

        $user = new UserModel;
// 数据保存
        $user->allowField(true)->save($data);
        return '用户[ ' . $user->nickname . ':' . $user->id . ' ]新增成功';
    }

    // 批量新增用户数据
    public function addList() {//http://tp5.com:8080/user/add_list
        $user = new UserModel;
        $list = [
            ['nickname' => '张三', 'email' => 'zhanghsan@qq.com', 'birthday' => strtotime('1
988-01-15')],
            ['nickname' => '李四', 'email' => 'lisi@qq.com', 'birthday' => strtotime('1990-0
9-19')],
        ];
        if ($user->saveAll($list)) {
            return '用户批量新增成功';
        } else {
            return $user->getError();
        }
    }

    // 读取用户数据
    public function read($id = '') {//http://tp5.com:8080/user/1
//        $user = UserModel::get($id);
//        echo $user->nickname . '<br/>';
//        echo $user->email . '<br/>';
//        echo date('Y/m/d', $user->birthday) . '<br/>';
//        echo $user['nickname'] . '<br/>';//系统为模型实现了ArrayAccess 接口，因此仍然可以通过数组的方式访问对象实例， （难道不是更安全吗）
//        echo $user['email'] . '<br/>';
//        echo date('Y/m/d', $user['birthday']) . '<br/>';
//        $user = UserModel::get(['nickname' => '流年']);
//        echo $user->nickname . '<br/>';
//        echo $user->email . '<br/>';
//        echo date('Y/m/d', $user->birthday) . '<br/>';
        $user = UserModel::where('nickname', '流年')->find();
        echo $user->nickname . '<br/>';
        echo $user->email . '<br/>';
        echo date('Y/m/d', $user->birthday) . '<br/>';
    }

    // 更新用户数据
    public function update($id) {//http://tp5.com:8080/user/update/7
//        $user = UserModel::get($id);
//        $user->nickname = '刘晨';
//        $user->email = 'liu21st@gmail.com';
//        if (false !== $user->save()) {
//            return '更新用户成功';
//        } else {
//            return $user->getError();
//        }
        $user['id'] = (int) $id;
        $user['nickname'] = '刘晨';
        $user['email'] = 'liu21st@gmail.com';
        $result = UserModel::update($user);
        return '更新用户成功';
    }

    // 删除用户数据
    public function delete($id) {//http://tp5.com:8080/user/delete/1
//        $user = UserModel::get($id);
//        if ($user) {
//            $user->delete();
//            return '删除用户成功';
//        } else {
//            return '删除的用户不存在';
//        }
        $result = UserModel::destroy($id);
        if ($result) {
            return '删除用户成功';
        } else {
            return '删除的用户不存在';
        }
    }

    // 创建用户数据页面
    public function create() {//http://tp5.com:8080/user/create
        return view();
        // return view('user/create');
    }

}
