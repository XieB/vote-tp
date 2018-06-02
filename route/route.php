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
Route::post(':version/token/admin', ':version/token/loginFromUserPassword');
Route::post(':version/token/user', ':version/token/loginFromOpenId');

//投票
Route::post(':version/vote',':version/vote/add');
Route::get(':version/vote$',':version/vote/get');
Route::delete(':version/vote',':version/vote/delete');
Route::get(':version/vote/one',':version/vote/getOne');
Route::put(':version/vote',':version/vote/update');

//设置
Route::put(':version/system/pass',':version/system/resetPass');


//其他测试
Route::any(':version/token/test', ':version/token/test');

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::get('hello/:name', 'index/hello');

return [

];
