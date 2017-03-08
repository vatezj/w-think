<?php
namespace app\common\model;


use think\Validate;
/**
* 模型基类
*/
class Menu extends \think\Model{
	protected $name = "menu";
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

	public function findInfo($field = '*'){
		$res  = db($this->name)->order('listorder asc')->field($field)->select();
		// p($this->getTree($res));die;
		return $this->getTree($res);
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
	


	function generateTree($items){
    $tree = array();
    foreach($items as $item){
        if(isset($items[$item['parentid']])){
        	 // $items[$item['parentid']]['son'] = array();
            $items[$item['parentid']]['son'][] = &$items[$item['id']];
        }else{
            $tree[] = &$items[$item['id']];
        }
    }
    return $tree;
}





 	function aagetTree($data, $pId)
	{
		$tree = '';
		foreach($data as $k => $v)
		{
		 if($v['parentid'] == $pId)
		 { //父亲找到儿子
		 $v['parentid'] = $this->aagetTree($data, $v['id']);
		 $tree[] = $v;
		 //unset($data[$k]);
		 }
		}
		return $tree;
	}


                    

	function getTaaaree($data, $pId)
			{
			$html = '';
			foreach($data as $k => $v)
			{
			 if($v['parentid'] == $pId)
			 { //父亲找到儿子
			 $html .= "<ul class=\"nav nav-second-level\">
                            <li>
                               <a href=\"#\">".$v['name'];
			 $html .= $this->getTaaaree($data, $v['id']);
			 $html = $html."<span class=\"fa arrow\"></span></a><li></ul>";
			 }
			}
			return $html ? '<li>'.$html.'</li>' : $html ;
			}



	public function tree(&$data,$pid = 0,$count = 1) {
        foreach ($data as $key => $value){
            if($value['parentid']==$pid){
                $value['count'] = $count;
                self::$treeList []=$value;
                unset($data[$key]);
                self::tree($data,$value['id'],$count+1);
            } 
        }
        return self::$treeList ;
    }


     public static function getTree($data,$pid='0'){
        $arr = array();
        foreach($data as $k=>$v){
            if($v["parentid"] == $pid){
            	$data[$k]['end'] = 1;
                $arr[] = $data[$k];
                foreach($data as $m=>$n){
                    if($v["id"] == $n["parentid"]){
                        $data[$m]["name"] = "　　├".$data[$m]["name"];
                        $data[$m]['end'] = 2;
                        $arr[] = $data[$m];
                        foreach($data as $j=>$i){
                            if($n["id"] == $i["parentid"]){
                                $data[$j]["name"] = "　　　　├".$data[$j]["name"];
                                $data[$j]['end'] = 3;
                                $arr[] = $data[$j];
	                                foreach($data as $s=>$b){
			                            if($n["id"] == $n["parentid"]){
			                                $data[$s]["name"] = "　　　　├".$data[$s]["name"];
			                                $data[$s]['end'] = 4;
			                                $arr[] = $data[$s];
			                                	foreach($data as $c=>$f){
						                            if($n["id"] == $n["parentid"]){
						                                $data[$c]["name"] = "　　　　├".$data[$c]["name"];
						                                $data[$c]['end'] = 5;
						                                $arr[] = $data[$c];
						                            }
						                        }
			                            }
			                        }
                            }
                        }
                    }
                }
            }
        }
        return $arr;
    }

     public static function getTowTree($data,$pid='0'){
        $arr = array();
        foreach($data as $k=>$v){
            if($v["parentid"] == $pid){
            	 $data[$k]['end'] = 1;
                $arr[] = $data[$k];
               
                foreach($data as $m=>$n){
                    if($v["id"] == $n["parentid"]){
                        $data[$m]["name"] = "　　├".$data[$m]["name"];
                         $data[$m]['end'] = 2;
                        $arr[] = $data[$m];
                       
                        // foreach($data as $j=>$i){
                        //     if($n["id"] == $i["parentid"]){
                        //         // $data[$j]["name"] = "　　　　├".$data[$j]["name"];
                        //         // $arr[] = $data[$j];
                        //         // $data[$j]['end'] = 3;
                        //         // unset($data[$j]);
                               
	                     
                        //     }
                        // }
                    }
                }
            }
        }
        return $arr;
    }


    public function menuLists(){
		$map['parentid'] = 0;
		$res = db($this->name)->select();
		foreach ($res as $key => $value) {
			# code...
		}
	}


function get_tree_child($data, $fid) {
    $result = array();
    $fids = array($fid);
    do {
        $cids = array();
        $flag = false;
        foreach($fids as $fid) {
            for($i = count($data) - 1; $i >=0 ; $i--) {
                $node = $data[$i];
                if($node['parentid'] == $fid) {
                    array_splice($data, $i , 1);
                    $result[] = $node['id'];
                    $cids[] = $node['id'];
                    $flag = true;
                }
            }
        }
        $fids = $cids;
    } while($flag === true);
    return $result;
}




}