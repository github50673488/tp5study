<?php

namespace app\index\controller;

class HelloWorld
{
    public function index($name = 'World')//http://tp5.com/index/hello_world?name=liu
    {
        return 'Hello,' . $name . '！';
    }
}