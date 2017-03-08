<?php
namespace app\index\controller;

class Index
{
    public function index($name="胡扬星")
    {
        return '这里是前台页面'.$name;
    }
}
