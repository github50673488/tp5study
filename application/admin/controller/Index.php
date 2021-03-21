<?php
namespace app\admin\controller;

use think\Controller;

class Index extends Controller
{
	// http://tp5.com/index.php/admin/index/index/
    public function index()
    {
		return $this->fetch('project');
    }

}

