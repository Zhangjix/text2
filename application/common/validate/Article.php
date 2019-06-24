<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2019/5/24
 * Time: 21:22
 */

namespace app\common\validate;
use think\Validate;

class Article extends Validate
{
    protected $rule=[
        'title|标题'=>'require|length:5,20', //chsAlphaNum 仅限数字和字母
        'context|文章内容'=>'require',
        'user_id|作者'=>'require',
        'cate_id|栏目名称'=>'require',
//        'title_img|标题图片'=>'require'
    ];
}