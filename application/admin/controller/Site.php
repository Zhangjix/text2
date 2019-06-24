<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2019/6/16
 * Time: 14:04
 */

namespace app\admin\controller;
use app\admin\common\controller\Base;
use app\admin\common\model\Site as SiteModel;
use think\facade\Request;
use think\facade\Session;


class Site extends Base
{
    //站点管理首页
    public function index(){
        $siteInfo = SiteModel::get(['status'=>1]);

        $this->view->assign('siteInfo',$siteInfo);

        return $this->view->fetch('index');
    }

    //保存站点修改信息
    public function storage(){
        $data = Request::param();

        if(SiteModel::update($data)){
            $this->success('更新成功','index');
        }
            $this->error('更新失败');
    }
}