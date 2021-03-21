<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;
// use \traits\controller\Jump;  如果你的控制器类是继承的\think\Controller的话，系统已经自动为你引入了 \traits\controller\Jump

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

//大多数情况，我们不需要关注Response对象本身，只需要在控制器的操作方法中返回数据即可，系统会根据default_return_type和default_ajax_return配置决定响应输出的类型。
//
//默认的自动响应输出会自动判断是否AJAX请求，如果是的话会自动输出default_ajax_return配置的输出类型，下面的例子，由于是html，会出错
    public function hello8()//http://tp5.com/index/index/hello8
    {
        $data = ['name' => 'thinkphp', 'status' => '1'];
        return $data;
    }

//手动输出
//在必要的时候，可以手动控制输出类型和参数，这种方式较为灵活。如果需要指定输出类型，可以通过下面的方式
    public function hello9()//http://tp5.com/index/index/hello9
    {
        $data = ['name' => 'thinkphp', 'status' => '1'];
        return json($data);
    }

//页面跳转
//如果需要进行一些简单的页面操作提示或者重定向，可以引入traits\controller\Jump，就可以使用相关页面跳转和重定向方法，
//下面举一个简单的例子，当页面传入name参数为thinkphp的时候，跳转到欢迎页面，其它情况则跳转到一个guest页面。
    public function hello10($name='')//http://tp5.com/index/index/hello10?name=thinkphp
    {
        if ('thinkphp' == $name) {
            $this->success('欢迎使用ThinkPHP
        5.0','hello11');
        } else {
            $this->error('错误的name','guest');
        }
    }

    public function hello11()
    {
        return 'Hello11,ThinkPHP!';
    }

    public function guest()
    {
        return 'Hello,Guest!';
    }
    //在任何时候（即使没有引入Jump trait的话），我们可以使用系统提供的助手函数redirect函数进行重定向。
    public function hello12($name='')//http://tp5.com/index/index/hello12?name=thinkphp
    {
        if ('thinkphp' == $name) {
            $this->redirect('http://thinkphp.cn');
        } else {
            $this->success('欢迎使用ThinkPHP','hello13');
        }
    }

    public function hello13()
    {
        return 'Hello13,ThinkPHP!';
    }



}
