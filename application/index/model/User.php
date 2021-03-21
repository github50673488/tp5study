<?php

namespace app\index\model;

use think\Model;

class User extends Model {

    // 设置完整的数据表（包含前缀）
    protected $table = 'think_user';
// 设置单独的数据库连接
    protected $connection = [
// 数据库类型
        'type' => 'mysql',
// 服务器地址
        'hostname' => 'localhost',
// 数据库名
        'database' => 'tp5study',
// 数据库用户名
        'username' => 'root',
// 数据库密码
        'password' => 'thesarasa0330',
// 数据库连接端口
        'hostport' => '3306',
// 数据库连接参数
        'params' => [],
// 数据库编码默认采用utf8
        'charset' => 'utf8',
// 数据库表前缀
        'prefix' => 'think_',
// 数据库调试模式
        'debug' => true,
    ];
    // 定义类型转换
    protected $type = [
        'birthday' => 'timestamp:Y/m/d',
    ];
// 定义自动完成的属性
    protected $insert = ['status'];

// status修改器
    protected function setStatusAttr($value, $data) {
        return '流年' == $data['nickname'] ? 1 : 2;
    }

// status读取器
    protected function getStatusAttr($value) {
        $status = [-1 => '删除', 0 => '禁用', 1 => '正常', 2 => '待审核'];
        return $status[$value];
    }

// email查询
    protected function scopeEmail($query) {
        $query->where('email', 'thinkphp@qq.com');
    }

// status查询
    protected function scopeStatus($query) {
        $query->where('status', 1);
    }

}
