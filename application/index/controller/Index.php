<?php
namespace app\index\controller;

use think\Controller;

class Index extends Controller
{
    public function index()//http://localhost/tp5study/
    {
        return 'hello world liu';
    }

    public function hello($name = 'thinkphp')//http://tp5study.com/index/index/hello
    {
        $this->assign('name', $name);
        return $this->fetch();//fetch方法中我们没有指定任何模板，所以按照系统默认的规则（视图目录/控制器/操作方法）输出了view/index/hello.html模板文件。
    }
}
