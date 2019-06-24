<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2019/6/15
 * Time: 17:11
 */

namespace app\admin\controller;
use app\admin\common\controller\Base;
use app\admin\common\model\Article as ArtModel;
use app\admin\common\model\Cate;
use think\facade\Request;
use think\facade\Session;

class Article extends Base
{
    //文章管理的首页
    public function index(){
        $this->isLogin();
        //跳转到文章管理界面
        return $this->redirect('artlist');
    }

    //渲染文章管理界面
    public function artList(){
        $this->isLogin();

        $userId = Session::get('user_id');
        $isAdmin = Session::get('admin_level');

       $artList = ArtModel::where('user_id',$userId)->paginate(8);

       if($isAdmin == "超级管理员"){
           $artList = ArtModel::paginate(8);
       }

        $this->view->assign('title',' 文章管理');
        $this->view->assign('empty','<span style="color: red;">没有文章</span>');
        $this->view->assign('artList',$artList);

        return $this->view->fetch('artList');
    }

    //渲染编辑文章管理
    public function artEdit(){
        $artId = Request::param('id');
        $artInfo = ArtModel::where('id',$artId)->find();

        //获取栏目信息
        $cateList = Cate::all();

        $this->view->assign('title','编辑文章');
        $this->view->assign('cateList',$cateList);
        $this->view->assign('artInfo',$artInfo);
        return  $this->view->fetch('artedit');
    }

    //保存编辑文章管理
    public function storage()
    {
        $data = Request::param();
        //获取上传的更新图片
        $file = Request::file('title_img');
        //文件信息验证
        $info = $file->validate([
            'size' => 5000000,
            'ext' => 'jpg,jpeg,png,gif',
        ])->move('uploads');
        if ($info) {
            $data['title_img'] = $info->getSaveName();
        } else {
            $this->error($file->getError());
        }
        //将数据存储在数据库中
        if (ArtModel::where('id', $data['id'])->data($data)->update()) {
            $this->success('更新成功', 'article/artlist');
        } else {
            $this->error('更新失败');
        }

    }

    //删除文章
    public function doDelete(){
        //获取当前传递的ID
        $data = Request::param('id');

        if(ArtModel::where('id',$data)->delete()){
            return $this->success('删除成功','article/artlist');
        }
        $this->error('删除失败');
    }
}