<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2019/5/24
 * Time: 22:13
 */

namespace app\index\controller;
use app\common\controller\Base;
use app\common\model\User;

class Test extends Base
{
   public function test1(){
       dump(User::get(27));

    }
}