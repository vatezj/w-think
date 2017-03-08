<?php
namespace app\admin\controller;

use think\Controller;

class Base extends Controller
{
    public function index()
    {
        return $this->fetch('Index/index');
   }

    public function login()
    {   
        return $this->fetch('Index/login');
    }

    public function main()
    {
        return $this->fetch('Index/main');
    }

    public function menu()
    {
        $info = model('Menu');
        $res = $info->findInfo();
        $this->assign('info', $res);
        return $this->fetch('Index/menu');
    }

    public function dologin()
    {
        session('user_auth','1111111111111');
        $this->redirect('admin/Index/index');
    }
}
