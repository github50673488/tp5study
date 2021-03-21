<?php
namespace app\index\controller;

class Blog
{
    // 在route.php 配置好了，所以以下的路由成立

// 访问id为5的内容
    public function get($id)//http://tp5.com/blog/5
    {
        return '查看id=' . $id . '的内容';
    }
// 访问name为thinkphp的内容
    public function read($name)//http://tp5.com/blog/thinkphp
    {
        return '查看name=' . $name . '的内容';
    }
// 访问2015年5月的归档内容
    public function archive($year, $month)//http://tp5.com/blog/2015/05
    {
        return '查看' . $year . '/' . $month . '的归档内容';
    }
}