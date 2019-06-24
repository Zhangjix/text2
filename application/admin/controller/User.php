<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2019/6/9
 * Time: 22:27
 */

namespace app\admin\controller;
use app\admin\common\controller\Base;
use think\facade\Request;
use app\admin\common\model\User as UserModel;
use think\facade\Session;


class User extends  Base
{
    public function login(){
        $this->logined();
        return $this->view->fetch('login',['title'=>'管理员登录']);
    }

    //验证后台登录
    public function checkLogin(){
        $data = Request::param();
        $map[] = ['email','=',$data['email']];
        $map[] = ['password','=',sha1($data['password'])];
        $result = UserModel::where($map)->find();
        if($result) {
            Session::set('user_id', $result['id']);
            Session::set('admin_name', $result['name']);
            Session::set('admin_level', $result['is_admin']);
            $this->success('登录成功', 'admin/user/userList');
        }

            $this->error('密码或邮箱错误，请重新登录');
    }

    //退出登录
    public function logout(){
//        Session::delete('user_id');
//        Session::delete('user_admin');
        Session::clear();
//        Session::destroy(); //这里不能用
        $this->success('退出成功，请稍等','admin/user/login');
    }

    //用户列表
    public function userList(){
        $data['user_id'] = Session::get('user_id');

        $data['admin_level'] = Session::get('admin_level');

        $userList = UserModel::where('id',$data['user_id'])->select();

        if($data['admin_level'] == '超级管理员'){
            $userList = UserModel::all();
        }
        $this->view->assign('title','用户管理');
        $this->view->assign('userList',$userList);
        $this->view->assign('empty','<span style="color: red;">没有任何数据</span>');

        return $this->view->fetch('userlist');
    }

    //渲染编辑用户的界面
    public function userEdit(){
         $userId = Request::param('id');
         $userInfo = UserModel::where('id',$userId)->find();

         $this->view->assign('title','编辑用户');
         $this->view->assign('userInfo',$userInfo);

         return $this->view->fetch('userEdit');
    }

    //保存编辑用户的界面
    public function storage(){
        $data = Request::param();
         if($data['password'] !== UserModel::where('password',$data['password'])->find()) {
             $data['password'];
         }
        if($userInfo = UserModel::where('id',$data['id'])->data($data)->update()){
            return $this->success('更新成功','user/userList');
        }else{
            return $this->error('更新失败,请重新修改');
        }
    }

    //删除用户
    public function doDelete(){
        //获取当前传递的ID
        $data = Request::param('id');
        if(UserModel::where('id',$data)->delete()){
            return $this->success('删除成功','admin/user/userList');
        }
        $this->error('删除失败');
    }
}