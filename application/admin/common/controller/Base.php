<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2019/6/9
 * Time: 21:38
 */

namespace app\admin\common\controller;
use think\Controller;
use think\facade\Session;

class Base extends Controller
{
    public function initialize()
    {

    }

    //检查示是否已登录：防止重复登录
    protected function logined(){
        if(Session::has('user_id')){
            $this->success('客官，您已经登录','index/index');
        }
    }

    //检查示是否未登录：放在需要登录操作的方法的最前面,列如发布文章
    protected function isLogin(){
        if(!Session::has('user_id')){
            $this->success('客官，您是不是忘记登录啦','user/login');
        }
    }


}