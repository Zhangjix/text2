<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2019/5/24
 * Time: 21:22
 */

namespace app\common\validate;
use think\Validate;

class User extends Validate
{
//    private $aq = 'dwqdwqdwqdwqdwq';

    protected $rule=[
/*     'name|姓名'=>'require|length:5,20|chsAlphaNum',*/
       'name|用户名'=>[
        'require',
        'length'=>'5,20',
        'chsAlphaNum'=>'chsAlphaNum' //允许汉子、数字和字母
      ],

        'password|密码'=>[
          'require',
          'length'=>'6,20',
          'alphaNum'=>'alphaNum', //允许数字和字母
          'confirm' //自动与password_confirm进行自动相等验证
        ],
        'email|邮箱'=>[
          'require',
          'email'=>'email',
          'unique'=>'user' //该字段必须在User表中是唯一
        ],
    ];
}