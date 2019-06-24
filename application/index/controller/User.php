<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2019/5/29
 * Time: 21:43
 */

namespace app\index\controller;
use app\common\controller\Base;
use think\facade\Request;
use app\common\model\User as UserModle;
use think\facade\Session;
class User extends Base
{
    /**注册页面
     * @return mixed
     */
        public function register(){
         //验证是否关闭注册功能
        $this->is_reg();

        $this->assign('title','用户注册');
        return $this->fetch();
    }

    /**处理用户提交的注册信息
     * @return array
     */
    public function insert(){
        if(Request::isAjax()){
            //验证数据
          $data = Request::post();
          $rule = 'app\common\validate\User';
          $res = $this->validate($data,$rule);
            if($res !== true){
                return ['status'=>-1,'message'=>$res];
            }else{
                //模型获取数据
                $data = Request::except('password_confirm','post');
//                $data['role'] = 1;  可以添加其他数据
                if( $user = UserModle::create($data)){
                    //注册后实现自动登录
                    $res = UserModle::get($user->id);
                    Session::set('user_id',$res->id);
                    Session::set('user_name',$res->name);
                    return ['status'=>1,'message'=>'注册成功'];
                }else{
                    return ['status'=>0,'message'=>'注册失败'];
                }
            }
        }else{
            $this->error("请求类型错误",'register');
        }
    }

    /**用户登录
     * @return string
     * @throws \Exception
     */
    public function login(){
        $this->logined();
        return $this->view->fetch('login',['title'=>'用户登录']);
    }

    /**用户登录与验证
     * @return array
     */
    public function loginCheck(){
        if(Request::isAjax()){
            //验证数据
            $data = Request::post();
            $rule = [
                'email|邮箱'=>'require|email',
                'password|密码'=>'require|alphaNum'
            ];
            $res = $this->validate($data,$rule);
            if($res !== true){
                return ['status'=>-1,'message'=>$res];
            }else{
                //模型查询数据
                $result = UserModle::get(function ($query) use ($data){
                    $query->where('email',$data['email'])
                          ->where('password',sha1($data['password']));
                });
                if($result == null){
                    return ['status'=>0,'message'=>'邮箱或密码不正确，请检查'];
                }else{
                    //将用户的数据写到session
                    Session::set('user_id',$result->id);
                    Session::set('user_name',$result->name);
                    Session::set('admin_level', $result['is_admin']);
                    return ['status'=>1,'message'=>'登录成功'];
                }
            }
        }else{
            $this->error("请求类型错误",'login');
        }
    }

    //退出登录
    public function logout(){
//        Session::delete('user_id');
//        Session::delete('user_admin');
        Session::clear();
//        Session::destroy(); //这里不能用
        $this->success('退出成功，请稍等','index/index');
    }



    
}