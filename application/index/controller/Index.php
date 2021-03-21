<?php
namespace app\index\controller;

use think\Controller;
use think\Db;

class Index extends Controller
{
    public function index()//http://tp5.com
    {
        $data = Db::name('data')->find();
        $this->assign('result', $data);
        return $this->fetch();
    }

    public function hello($name = 'thinkphp')//http://tp5.com/index/index/hello
    {
        $this->assign('name', $name);
        return $this->fetch();//fetch方法中我们没有指定任何模板，所以按照系统默认的规则（视图目录/控制器/操作方法）输出了view/index/hello.html模板文件。
    }

    public function hello1($name = 'World', $city = '')
        //http://tp5.com/index/index/hello1?city=shanghai&name=thinkphp
        // or http://tp5.com/index.php/index/index/hello1/city/shanghai/name/thinkphp
    {
        return 'Hello,' . $name . '! You come from ' . $city . '.';
    }
}
