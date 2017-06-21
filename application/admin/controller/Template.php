<?php
namespace app\admin\controller;

use app\common\controller\Admin;

class Template extends Admin
{
    public function choose()
    {
        $filenames = $this->get_filenamesbydir("./Template");
        //打印所有文件名，包括路径
        $str2 = '.html';
        foreach ($filenames as $k=>$v)
        {
            if( strrchr($v,$str2)==$str2 )
            {

            }
            else{
                unset($filenames[$k]);
            }
        }
        $this->assign('info', $filenames);
        return $this->fetch('Template/choose');
    }


    function get_allfiles($path,&$files) {
            if(is_dir($path)){
                $dp = dir($path);
                while ($file = $dp ->read()){
                    if($file !="." && $file !=".."){
                        $this->get_allfiles($path."/".$file, $files);
                    }
                }
                $dp ->close();
            }
            if(is_file($path)){
                $files[] =  $path;
            }
        }

    function get_filenamesbydir($dir)
    {
        $files = array();
        $this->get_allfiles($dir, $files);
        return $files;
    }


}