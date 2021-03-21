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

//系统推荐使用param方法统一获取当前请求变量，该方法最大的优势是让你不需要区分当前请求类型而使用不同的全局变量或者方法，并且可以满足大部分的参数需求
    public function hello6(Request $request)//http://tp5.com/index/index/hello6.html?test=ddd&name=thinkphp
    {
        echo '请求参数：';
        dump($request->param());
        echo 'name:'.$request->param('name');
    }

    public function hello7()//http://tp5.com/index/index/hello7.html?test=ddd&name=thinkphp
    {
        echo '请求参数：';
        dump(input());
        echo 'name:'.input('name');
    }

    public function hello5(Request $request,$name = 'World')//http://tp5.com/index/index/hello5.html?name=thinkphp
    {
        // 获取当前域名
        echo 'domain: ' . $request->domain() . '<br/>';
        // 获取当前入口文件
        echo 'file: ' . $request->baseFile() . '<br/>';
        // 获取当前URL地址 不含域名
        echo 'url: ' . $request->url() . '<br/>';
        // 获取包含域名的完整URL地址
        echo 'url with domain: ' . $request->url(true) . '<br/>';
        // 获取当前URL地址 不含QUERY_STRING
        echo 'url without query: ' . $request->baseUrl() . '<br/>';
        // 获取URL访问的ROOT地址
        echo 'root:' . $request->root() . '<br/>';
        // 获取URL访问的ROOT地址
        echo 'root with domain: ' . $request->root(true) . '<br/>';
        // 获取URL地址中的PATH_INFO信息
        echo 'pathinfo: ' . $request->pathinfo() . '<br/>';
        // 获取URL地址中的PATH_INFO信息 不含后缀
        echo 'pathinfo: ' . $request->path() . '<br/>';
        // 获取URL地址中的后缀信息
        echo 'ext: ' . $request->ext() . '<br/>';

        return 'Hello,' . $name . '！';
    }
}
