<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
use  think\Db;

//根据用户的主键id,查询用户名称
if(!function_exists('getUserName')) {
    function getUserName($id)
    {
        return Db::table('user')->where('id', $id)->value('name');
    }
}
    function getArtContext($context)
    {
        return mb_substr(strip_tags($context), 0, 10) . '...';
    }

if(!function_exists('getCateName')) {
    function getCateName($cateId)
    {
        return Db::table('article_category')->where('id', $cateId)->value('name');
    }

}
