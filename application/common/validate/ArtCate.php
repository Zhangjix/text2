<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2019/6/5
 * Time: 21:58
 */

namespace app\common\validate;
use think\Validate;

class ArtCate extends Validate
{
    protected $rule=[
        'name|标题'=>'require|length:3,20|chsAlpha'
    ];

}