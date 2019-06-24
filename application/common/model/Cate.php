<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2019/6/5
 * Time: 21:35
 */

namespace app\common\model;
use think\Model;

class Cate extends Model
{
    protected  $pk = 'id';
    protected  $table = 'article_category';

    protected $autoWriteTimestamp = true; //自动时间戳
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    protected $dateFormat = 'Y年m月d日 H:i:s';

    //开启自动设置
    protected $auto = []; //无论是新增或是更新都要设置的字段
    //仅新增的有效
    protected $insert = ['create_time','status'=>1];
    //仅更新的时设置
    protected $update = ['update_time'];
}