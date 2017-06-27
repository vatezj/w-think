<?php
namespace app\admin\controller;

use app\common\controller\Admin;

use think\Db;
use \think\Config;

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
        return $this->fetch('Index/menu');
    }

    public function dologin()
    {
        session('user_auth','1111111111111');
        $this->redirect('admin/Index/index');
    }

    public function system()
    {

        $model = db('system');
        if(IS_POST)
        {
            $system = array(
                'title'    =>  $_POST['title'],
                'keywords'  =>  $_POST['keyword'],
                'company'  =>  $_POST['company'],
                'filing'   =>  $_POST['filing'],
                'description'   =>  $_POST['description'],
            );
            $res = $model->where(array('id'=>1))->update($system);
            if($res){
                $data['status'] = 2;
                $data['url'] = url('admin/Index/system');
                $data['content'] = '修改成功';
            }else{
                $data['status'] = 1;
                $data['content'] = '修改失败';
            }
            return $data;
        }
        $info = $model->find(1);
        $this->assign('info',$info);
        return $this->fetch('Index/system');
    }

    public function clear(){
        if(is_dir('./runtime/temp')){
            $info = $this->delDirAndFile('./runtime/temp');
        }
        if(is_dir('./runtime/cache')){
            $info = $this->delDirAndFile('./runtime/cache');
        }
        return $info;
    }
    //删除文件夹（包括文件夹）
    protected function delDirAndFile( $dirName )
    {
        if ( $handle = opendir( "$dirName" ) ) {
            while ( false !== ( $item = readdir( $handle ) ) ) {
                if ( $item != "." && $item != ".." ) {
                    if ( is_dir( "$dirName/$item" ) ) {
                        delDirAndFile( "$dirName/$item" );
                    } else {
                        unlink( "$dirName/$item" );
                    }
                }
            }
            closedir( $handle );
            if(rmdir( $dirName )){
                $data = [
                    'code'=>1,
                    'message'=>'清除成功'
                ];
            } else {
                $data = [
                    'code'=>2,
                    'message'=>'清除失败'
                ];
            }
        }
    }
    //删除文件夹（不包括文件夹）
    protected function delFileUnderDir( $dirName )
    {
        if ( $handle = opendir( "$dirName" ) ) {
            while ( false !== ( $item = readdir( $handle ) ) ) {
                if ( $item != "." && $item != ".." ) {
                    if ( is_dir( "$dirName/$item" ) ) {
                        delFileUnderDir( "$dirName/$item" );
                    } else {
                        if( unlink( "$dirName/$item" ) )echo "成功删除文件： $dirName/$item\n";
                    }
                }
            }
            closedir( $handle );
        }
    }
}
