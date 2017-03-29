<?php
namespace app\admin\controller;

use app\common\controller\Admin;

class Article extends Admin
{

    protected $model =  'Article';

    public function _initialize() {
       
        parent::_initialize();
    }

    public function index()
    {
        $info = model('Article');
        $res = $info->findInfo();
        $this->assign('info', $res);
       
         // p($res);die;
        return $this->fetch('Article/index');
   }


    public function edit()
    {
        if(IS_POST){
            $res = model($this->model)->updateMenu($_POST);
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
        return $this->fetch('Article/edit');
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
                $data['url'] = url('admin/Article/index');
                $data['content'] = $res['content'];
            }else{
                $data['status'] = 1;
                $data['content'] = $res['content'];
            }
            return $data;
        	// // $this->success("设置成功");
        }

        return $this->fetch('Article/add');
   }

   public function typeclass(){
        return $this->fetch('Article/typeclass');
   }
  
}
