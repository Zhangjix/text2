<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2019/5/24
 * Time: 21:10
 */

namespace app\common\controller;

use think\Controller;
use think\facade\Session;
use app\common\model\ArtCate;
use app\common\model\Article;
use app\admin\common\model\Site;
use think\facade\Request;

class Base extends Controller
{

    public function initialize(){
       //显示分类导航
        $this->showNav();

        //检测是否关闭
        $this->is_open();

        //获取右侧数据内容
        $this->getHotArt();
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

    //显示分类导航
    protected function showNav(){
           $cateList = ArtCate::all(function ($query){
           $query->where('status',1)->order('sort','asc');
       });
       //赋值
        $this->view->assign('cateList',$cateList);
    }

    //检测站点是否关闭
    public function is_open(){
        $isOpen = Site::where('status',1)->value('is_open');

        //只允许关闭前台
       if($isOpen ==0 && Request::module()=='index'){
           $info = <<< 'INFO'
        <body style="background-color: #333333">
        <h1 style="color: #eee;text-align: center;margin: 200px;">站点维护中...</h1>
        </body>
INFO;
           exit($info);
        }
    }

    //检测注册是否关闭
    public function is_reg(){
        $isReg = Site::where('status',1)->value('is_reg');
        if($isReg == 0){
            return $this->error('注册已关闭','index/index');
        }

    }

    //根据阅读量PV来获取内容
    public function getHotArt(){
        $hotArtList = Article::where('status',1)->order('pv','desc')->limit(12)->select();

        $this->view->assign('hotArtList',$hotArtList);
    }
}
