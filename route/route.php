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
//管理端
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

Route::get('admin/vote/result$','admin/vote/voteResult'); //获取选项记录
Route::get('admin/vote/votePersonNums','admin/vote/votePersonNums');
Route::get('admin/system/oneUserInfo$','admin/system/oneUserInfo');   //获取用户详细信息

//用户
Route::get('user/vote$','user/vote/getList');
Route::put('user/setting/user$','user/setting/updateUserInfo');
Route::get('user/setting/user$','user/setting/getUserInfo');
//Route::put('user/setting/test','user/setting/test');
Route::get('user/option$','user/option/getList');
Route::get('user/vote/one$','user/vote/getOne');

Route::post('user/vote/radio$','user/vote/doRadio');    //单选投票
Route::post('user/vote/checkbox$','user/vote/doCheckbox');  //复选投票
Route::get('user/vote/voted$','user/vote/hasVote'); //是否已经投票
Route::get('user/vote/result$','user/vote/voteResult'); //获取选项记录
Route::get('user/vote/votePersonNums','user/vote/votePersonNums');

//其他测试
Route::any('admin/token/test', 'admin/token/test');

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::get('hello/:name', 'index/hello');

return [

];
