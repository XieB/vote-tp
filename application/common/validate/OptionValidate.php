<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/7
 * Time: 9:47
 */

namespace app\common\validate;


class OptionValidate extends BaseValidate
{
    protected $rule = [
        'ownerId' => 'require|number',
    ];
    protected $scene = [
        'get' => ['ownerId'],
    ];

}