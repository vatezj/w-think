<?php
namespace app\common\model;


use think\Validate;
/**
* 模型基类
*/
class Article extends \think\Model{
	protected $name = "Article";
	static public $treeList = array();
	public $rule = array(
    'name'  => 'require|max:25',
    'app'   => 'require',
    'model'   => 'require',
    'action'   => 'require',
    'app'   => 'require',
    'email' => 'email',
	);

	public $msg = array(
    'name.require' => '名称必须',
    'app.require' => '应用必须',
    'model.require' => '控制器必须',
    'action.require' => '方法名必须',
	);

	public function findInfo(){
		$res  = db($this->name)->order('id asc')->select();
		return $res;
	}

	public function findMenuInfoById($id){
		$map['id'] = array('IN', $id);
		$res  = db($this->name)->where($map)->find();
		return $res;
	}

	public function listInfo(){
		$res  = db($this->name)->order('listorder asc')->select();
		foreach ($res as $key => $value) {
			# code...
			$res[$key]['url'] = $res[$key]['app'].'/'.$res[$key]['model'].'/'.$res[$key]['action'].$res[$key]['data'];
		}
		return $this->recursion($res);
		
	}

		public function listTowInfo(){
		$res  =  db('Menu')->order('listorder asc')->select();
		return $this->getTowTree($res);
		
	}
	public function menuAdd($data){
			$validate = new Validate($this->rule, $this->msg);
			$result   = $validate->check($data);
			if(!$result){
				$date['content'] = $validate->getError();
				$date['status'] = 1;
				return $date;
			}else{
				$date['content'] = self::create($data);
				$date['status'] = 2;
				return $date;
			}			
	}


	public function menuDel($id){
		$res  = db($this->name)->where(array('id'=>$id))->delete();
		return $res;
	}


	public function updateMenu ($data){
		$id = $data['id'];
		unset($data['id']);
		$validate = new Validate($this->rule, $this->msg);
		$result   = $validate->check($data);
		if(!$result){
			$date['content'] = $validate->getError();
			$date['status'] = 1;
			return $date;
		}else{

			// $res =db($this->name)->save();
			$date['content'] = self::save($data, array('id'=>$id));
			$date['status'] = 2;
			return $date;
		}		
	}


	function recursion($data, $id=0) {
		 $list = array();
		 foreach($data as $v) {
		 if($v['parentid'] == $id) {
		 $v['son'] = $this->recursion($data, $v['id']);
		 if(empty($v['son'])) {
		 $v['son'] = 1;
		 }
		 array_push($list, $v);
		 }
		 }
		 return $list;
	}
	

}