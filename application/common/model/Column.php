<?php
namespace app\common\model;


use think\Validate;
/**
 * 模型基类
 */
class Column extends \think\Model{
    protected $name = "Column";
    public $rule = array(
        'title'  => 'require|max:225',

        'template'   => 'require'
    );

    public $msg = array(
        'title.require' => '名称必须',

        'template.require' => '必须有模板',
    );

    public function findInfo(){
        $res  = db($this->name)->order('id asc')->select();
        return $res;
    }

    public function addColumn($data)
    {
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

    public function findColumnInfoById($id){
        $map['id'] = array('IN', $id);
        $res  = db($this->name)->where($map)->find();
        return $res;
    }

    public function listTowInfo()
    {
        $res = db('Column')->order('sort asc')->select();
        return $this->getTowTree($res);
    }
    public static function getTowTree($data,$pid='0'){
        $arr = array();
        foreach($data as $k=>$v){
            if($v["pid"] == $pid){
                $data[$k]['end'] = 1;
                $arr[] = $data[$k];

                foreach($data as $m=>$n){
                    if($v["id"] == $n["pid"]){
                        $data[$m]["title"] = "　　├".$data[$m]["name"];
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

}