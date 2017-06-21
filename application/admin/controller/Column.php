<?php
namespace app\admin\controller;

use app\common\controller\Admin;

class Column extends Admin
{
    protected $model =  'Column';

    public function _initialize() {

        parent::_initialize();
    }
    public function index()
    {
        $info = model('Column');
        $res = $info->findInfo();
        $this->assign('info', $res);


        return $this->fetch('Column/index');
    }

    public function  add()
    {
        if(IS_POST){
            $res = model($this->model)->addColumn($_POST);
            // p($res);die;
            if($res['status'] == 2){
                $data['status'] = 2;
                $data['url'] = url('admin/Column/index');
                $data['content'] = $res['content'];
            }else{
                $data['status'] = 1;
                $data['content'] = $res['content'];
            }
            return $data;
        }
        return $this->fetch('Column/add');
    }

    public function edit()
    {
        if(IS_POST){
            $res = model($this->model)->updateColumn($_POST);
            // p($res);die;
            if($res['status'] == 2){
                $data['status'] = 2;
                $data['url'] = url('admin/Article/index');
                $data['content'] = $res['content'];
            }else{
                $data['status'] = 1;
                $data['content'] = $res['content'];
            }
            return $data;
            // // $this->success("设置成功");
        }
        $id = $this->getArrayParam('id');
        $res = model($this->model)->findColumnInfoById($id);
        $this->assign('info', $res);
        p($res);die;
        $result = model($this->model)->listTowInfo();
        foreach ($result as $k => $v) {
            $result[$k]['selected'] = $result[$k]['id'] == $res['pid'] ? 'selected' : '';

            // $str = "<option value='\$id' \$selected>\$spacer \$name</option>";
        }
        $this->assign('lists',$result);
        // p($res);die;
        return $this->fetch('Column/edit');
    }
}