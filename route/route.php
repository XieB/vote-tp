<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
Route::allowCrossDomain(true);     //允许跨域

//登录
Route::post('common/token/admin$', 'common/token/loginFromUserPassword');
Route::get('common/token/user$', 'common/token/loginFromOpenId');

//投票
Route::post('admin/vote$','admin/vote/add');
Route::get('admin/vote$','admin/vote/get');
Route::delete('admin/vote$','admin/vote/delete');
Route::get('admin/vote/one$','admin/vote/getOne');
Route::put('admin/vote$','admin/vote/update');

//选项
Route::delete('admin/vote/option$','admin/vote/deleteOption');
Route::post('admin/vote/option$','admin/vote/addOption');

//设置
Route::put('admin/system/pass$','admin/system/resetPass');
Route::get('admin/system/noMember$','admin/system/getNoExamine');
Route::get('admin/system/member$','admin/system/getExamine');
Route::put('admin/system/member$','admin/system/examineSuccess');
Route::delete('admin/system/member$','admin/system/deleteMember');

//用户
Route::get('user/vote$','user/vote/getList');
Route::put('user/setting/user$','user/setting/updateUserInfo');
Route::get('user/setting/user$','user/setting/getUserInfo');
//Route::put('user/setting/test','user/setting/test');


//其他测试
Route::any('admin/token/test', 'admin/token/test');

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::get('hello/:name', 'index/hello');

return [

];
