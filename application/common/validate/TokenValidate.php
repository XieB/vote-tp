<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/29
 * Time: 15:13
 */

namespace app\common\validate;


class TokenValidate extends BaseValidate
{
    protected $rule = [
        'username'  =>  'require',
        'password' =>  'require',
        'code' =>   'require',
    ];
    protected $scene = [
        'code'  =>  ['code'],
        'user'  =>  ['username','password'],
    ];
}