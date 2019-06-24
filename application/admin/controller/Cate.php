<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2019/6/13
 * Time: 19:19
 */

namespace app\admin\controller;
use app\admin\common\controller\Base;
use app\admin\common\model\Cate as CateModel;
use think\facade\Request;
use think\facade\Session;

class Cate extends Base
{
    //分类管理的首页
    public function index(){
        $this->isLogin();
        return $this->redirect('cateList');
    }

    //渲染分类管理界面
    public function cateList(){
        $this->isLogin();
        $cateList = CateModel::all();

        $this->view->assign('title',' 分类管理');
        $this->view->assign('empty','<span style="color: red;">没有分类</span>');
        $this->view->assign('cateList',$cateList);

        return $this->view->fetch('cateList');
    }

    //渲染编辑分类
    public function cateEdit(){
       $cateId = Request::param('id');
       $cateInfo = CateModel::where('id',$cateId)->find();
        $this->view->assign('actionType','update');
       $this->view->assign('title','编辑分类');
       $this->view->assign('cateInfo',$cateInfo);

       return  $this->view->fetch('cateaction');
    }

    //保存编辑分类
    public function storage(){
       $data = Request::param();
       if(!CateModel::where('id',$data['id'])->data($data)->update()){

       }
        return $this->success('更新成功','cate/cateList');
    }

    //渲染新增编辑分类
    public function cateInsert(){
        $this->view->assign('title','新增分类');
        $this->view->assign('actionType','insert');

        $cateList = CateModel::all();
        $this->assign('cateList',$cateList);
        //发布界面渲染
        return $this->view->fetch('cateaction');
    }

    //新增编辑分类
    public function cateAdd()
    {
        $data =  Request::param();
        $data['user_id'] = Session::get('user_id');
        if( CateModel::create($data)){
            return $this->success('添加成功','cate/cateList');
        }$this->error('更新失败');

    }

    //删除分类
    public function doDelete(){
        //获取当前传递的ID
        $data = Request::param('id');
        if(CateModel::where('id',$data)->delete()){
            return $this->success('删除成功','admin/cate/cateList');
        }
        $this->error('删除失败');
    }

    //编辑分类的保存和新增结合
//    public function xxx(){
//        $data =  Request::param();
//        $actionType = $data['actionType'];
//        unset($data['actionType']);
//        switch ($actionType) {
//            case 'insert':
//                $data['user_id'] = Session::get('user_id'); //单独把数据列出来不会从表单里拿到多余的数据 可忽略
//                if( CateModel::create($data)){
//                    return $this->success('添加成功','cate/cateList');
//                }
//                break;
//            case 'update':
//                if(CateModel::where('id',$data['id'])->data($data)->update()){
//                    return $this->success('更新成功','cate/cateList');
//                }
//                break;
//            default:
//                echo '操作类型错误!';
//                exit;
//        }
//        $this->error('更新失败');
//    }




}