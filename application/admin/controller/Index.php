<?php
namespace app\admin\controller;

use app\common\controller\Admin;

use think\Db;

class Index extends Admin
{
    public function index()
    {
        $info = model('Menu');
        $res = $info->listInfo();
        $this->assign('info', $res);
        return $this->fetch('Index/index');
   }

    public function login()
    {   
        return $this->fetch('Index/login');
    }

     public function icon()
    {   
        return $this->fetch('Index/icon');
    }


    public function main()
    {
        $version = Db::query('SELECT VERSION() AS ver');
        $config  = [
            'url'             => $_SERVER['HTTP_HOST'],
            'document_root'   => $_SERVER['DOCUMENT_ROOT'],
            'server_os'       => PHP_OS,
            'server_port'     => $_SERVER['SERVER_PORT'],
            'server_ip'       => $_SERVER['SERVER_ADDR'],
            'server_soft'     => $_SERVER['SERVER_SOFTWARE'],
            'php_version'     => PHP_VERSION,
            'mysql_version'   => $version[0]['ver'],
            'max_upload_size' => ini_get('upload_max_filesize')
        ];
        $this->assign('config',$config);
        return $this->fetch('Index/main');
    }

    public function menu()
    {

        $info = model('Menu');
        $res = $info->findInfo();
        $this->assign('info', $res);
        p($res);die;
        return $this->fetch('Index/menu');
    }

    public function dologin()
    {
        session('user_auth','1111111111111');
        $this->redirect('admin/Index/index');
    }
}
