<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;

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

    public function hello2($name = 'World')//http://tp5.com/index/index/hello2.html?name=thinkphp
    {
        // 获取当前URL地址 不含域名
        echo 'url: ' . $this->request->url() . '<br/>';
        return 'Hello,' . $name . '！';
    }

//如果没有继承think\Controller，则可以使用Request对象注入的方式(use think\Request;)来简化调用，任何情况下都适用，也是系统建议的方式：
    public function hello3(Request $request, $name = 'World')//http://tp5.com/index/index/hello3.html?name=thinkphp
    {
        // 获取当前URL地址 不含域名
        echo 'url: ' . $request->url() . '<br/>';
        return 'Hello,' . $name . '！';
    }


//如果既没有继承think\Controller也不想给操作方法添加额外的Request对象参数，那么也可以使用系统提供的助手，
    public function hello4($name = 'World')//http://tp5.com/index/index/hello4.html?name=thinkphp
    {
        // 获取当前URL地址 不含域名
        echo 'url: ' . request()->url() . '<br/>';
        return 'Hello,' . $name . '！';
    }
}
