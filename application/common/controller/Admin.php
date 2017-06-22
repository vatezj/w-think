<?php
namespace app\common\controller;



class Admin extends Base
{
    public function _initialize() {
    	parent::_initialize();
        if (!is_login()) {
            $this->redirect('admin/Base/login');
        }

    }

}
