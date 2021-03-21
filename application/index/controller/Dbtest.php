<?php


namespace app\index\controller;

use think\Db;

class Dbtest
{
    public function createtest1()//http://tp5.com/index/dbtest/createtest1
    {
//        $result = Db::execute('insert into think_data1 (id, name ,status) values (5, "thinkphp",1)');
//        dump($result);
//        参数绑定
//实际开发中，可能某些数据使用的是外部传入的变量，为了让查询操作更加安全，我们建议使用参数绑定机制，例如上面的操作可以改为：

        $result =Db::execute('insert into think_data1 (id, name ,status) values (?, ?, ?)', [5, 'thinkphp', 1]);
        dump($result);

    }

    public function update1()//http://tp5.com/index/dbtest/update1
    {
        // 更新记录
        $result = Db::execute('update think_data1 set name = "framework" where id = 5 ');
        dump($result);
    }

    public function read1()//http://tp5.com/index/dbtest/read1
    {

        // 查询数据
//        $result = Db::query('select * from think_data1 where id = 5');
//        dump($result);
        $result = Db::query('select * from think_data1 where id = ?', [5]);
        dump($result);
    }

    public function delete1()//http://tp5.com/index/dbtest/delete1
    {

        // 删除数据
        $result = Db::execute('delete from think_data1 where id = 5 ');
        dump($result);
    }

    public function other1()//http://tp5.com/index/dbtest/other1
    {
        // 显示数据库列表
        $result = Db::query('show tables from demo');
        dump($result);
// 清空数据表
        $result = Db::execute('TRUNCATE table think_data');
        dump($result);
    }




}