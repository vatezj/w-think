<?php
namespace app\common\controller;



class Admin extends Base
{
    static public $system = array();
    public function _initialize() {
    	parent::_initialize();
        if (!is_login()) {
            $this->redirect('admin/Base/login');
        }
        self::$system['keyword'] = 1;
    }

}
