<?php
namespace app\admin\controller;

use app\common\controller\Admin;

class Menu extends Admin
{

    protected $model =  'Menu';

    public function _initialize() {
       
        parent::_initialize();
    }

    public function index()
    {
        $info = model('Menu');
        $res = $info->findInfo();
        $this->assign('info', $res);
       
         // p($res);die;
        return $this->fetch('Menu/index');
   }


    public function edit()
    {
        if(IS_POST){
            $res = model($this->model)->updateMenu($_POST);
            // p($res);die;
           if($res['status'] == 2){
                $data['status'] = 2;
                $data['url'] = url('admin/Menu/index');
                $data['content'] = $res['content'];
            }else{
                $data['status'] = 1;
                $data['content'] = $res['content'];
            }
            return $data;
            // // $this->success("设置成功");
        }
        $id = $this->getArrayParam('id');
        $res = model($this->model)->findMenuInfoById($id);
        $this->assign('info', $res);
        $result = model($this->model)->listTowInfo();
        foreach ($result as $k => $v) {
           $result[$k]['selected'] = $result[$k]['id'] == $res['parentid'] ? 'selected' : '';
         
            // $str = "<option value='\$id' \$selected>\$spacer \$name</option>";
        }
        // p($result);die;
        $this->assign('lists',$result);
         // p($res);die;
        return $this->fetch('Menu/edit');
   }

   public function del(){
        $id = $this->getArrayParam('id');
        $res = model($this->model)->menuDel($id[0]);
        if($res){
           return 1;
        }else{
           return 2;
        }
        
   }

   public function add()
    {

        if(IS_POST){
            $res = model($this->model)->menuAdd($_POST);
            // p($res);die;
           if($res['status'] == 2){
                $data['status'] = 2;
                $data['url'] = url('admin/Menu/index');
                $data['content'] = $res['content'];
            }else{
                $data['status'] = 1;
                $data['content'] = $res['content'];
            }
            return $data;
        	// // $this->success("设置成功");
        }
        $info = model('Menu');
        $res = $info->listTowInfo();
        if($this->getArrayParam('id')){
            $uid = $this->getArrayParam('id');
            foreach ($res as $k => $v) {
            $res[$k]['selected'] = $res[$k]['id'] == $uid[0] ? 'selected' : '';
        }
        }else{
             foreach ($res as $k => $v) {
            $res[$k]['selected'] = '';
        }
        }
       
        $this->assign('info', $res);
        return $this->fetch('Menu/add');
   }
  
}
