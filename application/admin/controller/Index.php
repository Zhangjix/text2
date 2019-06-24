<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2019/6/9
 * Time: 21:29
 */

namespace app\admin\controller;
use app\admin\common\controller\Base;

class Index extends Base
{
    public function  Index(){
       $this->isLogin();
       return $this->redirect('user/userList');
    }


}