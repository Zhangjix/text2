<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 2019/6/9
 * Time: 21:31
 */

//后台入口
namespace think;

// 加载基础文件
require __DIR__ . '/../thinkphp/base.php';

// 支持事先使用静态方法设置Request对象和Config对象

// 执行应用并响应
Container::get('app')->run()->send();