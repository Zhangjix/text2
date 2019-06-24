<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2019/5/24
 * Time: 21:21
 */

namespace app\admin\common\model;
use think\Model;

class User extends Model
{
    protected  $pk = 'id';
    protected  $table = 'user';
    protected $autoWriteTimestamp = true; //自动时间戳
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    protected $dateFormat = 'Y年m月d日';

    //获取器 绑定是否1与0 是对于错
    //public function get字段Attr()
    public function getStatusAttr($value){
        $status = ['1'=>'启用','0'=>'禁用'];
        return $status[$value];
    }

    public function  getIsAdminAttr($value){
        $is_Admin = [1=>'超级管理员',0=>'注册会员'];
        return $is_Admin[$value];
    }

    //修改器
    public function setPasswordAttr($value){
        return sha1($value);
    }
}