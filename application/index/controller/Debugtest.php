<?php


namespace app\index\controller;

use think\Db;

class Debugtest
{
    public function tracetest1()//http://tp5.com/index/debugtest/tracetest1
    {
        trace('这是测试调试信息');
        trace([1,2,3]);


    }

    public function excetiontest1()//http://tp5.com/index/debugtest/excetiontest1
    {
        return 'hello,'.$_GET['name'];
    }





}