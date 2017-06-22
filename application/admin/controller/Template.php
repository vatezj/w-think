<?php
namespace app\admin\controller;

use app\common\controller\Admin;
use \think\File;
use pclzip;

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

    public function index()
    {
        $res = $this->traverseDir('./Template');
        p($res);
    }

    public function add()
    {
        if(IS_POST){

            $targetFolder = '/uploads'; // Relative to the root

            $verifyToken = md5('unique_salt' . $_POST['Filename']);

            if (!empty($_FILES) == $verifyToken) {
                $tempFile = $_FILES['Filedata']['tmp_name'];
                $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
                $targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];

                // Validate the file type
                $fileTypes = array('jpg','jpeg','gif','png','zip','rar'); // File extensions
                $fileParts = pathinfo($_FILES['Filedata']['name']);

                if (in_array($fileParts['extension'],$fileTypes)) {
                    move_uploaded_file($tempFile,$targetFile);
                    $archive = new pclzip($targetFile);
                    if ($archive->extract(PCLZIP_OPT_PATH,'uploads') == 0) { /*解压缩路径跟原始档相同路径*/
                        die("Error : ".$archive->errorInfo(true));
                    }
                } else {
                    echo 'Invalid file type.';
                }
            }
            die;
        }
        return $this->fetch('Template/add');
    }

    public function del()
    {

    }

    function traverseDir($dir){
        $data = [];
        if($dir_handle = @opendir($dir)){
            while($filename = readdir($dir_handle)){
                if($filename != "." && $filename != ".."){
                    $subFile = $dir.DIRECTORY_SEPARATOR.$filename; //要将源目录及子文件相连
                    if(is_dir($subFile)){ //若子文件是个目录
                         $data[] = $filename; //输出该目录名称

                    }
                }
            }
            closedir($dir_handle);
        }
        return $data;
    }

    function unzip_file($file, $destination){
        $zip = new ZipArchive() ;
        if ($zip->open($file) !== TRUE) {
            die ("Could not open archive");
        }
        $zip->extractTo($destination);
        $zip->close();
        echo 'Archive extracted to directory';
    }
}

