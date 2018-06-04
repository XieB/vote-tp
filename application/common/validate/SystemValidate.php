<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/2
 * Time: 10:41
 */

namespace app\common\validate;


class SystemValidate extends BaseValidate
{
    protected $rule = [
        'oldPass'  =>  'require',
        'newPass' =>  'require',
        'reNewPass' => 'require',

    ];
    protected $scene = [
        'resetPass' => ['oldPass','newPass','reNewPass'],
    ];
}