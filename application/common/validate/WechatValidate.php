<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/4
 * Time: 16:03
 */

namespace app\common\validate;


class WechatValidate extends BaseValidate
{
    protected $rule = [
        'code'  =>  'require',
        'scope' => 'require',
    ];
}