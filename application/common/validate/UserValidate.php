<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/5
 * Time: 9:18
 */

namespace app\common\validate;


class UserValidate extends BaseValidate
{
    protected $rule = [
        'realName'  =>  'require',
        'mobile' =>  'require|mobile',
    ];
    protected $scene = [
        'user'  =>  ['realName','mobile'],
    ];
}