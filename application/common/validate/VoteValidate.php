<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/1
 * Time: 11:28
 */

namespace app\common\validate;


class VoteValidate extends BaseValidate
{
    protected $rule = [
        'title'  =>  'require',
        'type' =>  'require',
        'startTime' =>   'require',
        'endTime' =>    'require',
        'nameList' =>   'require',
        'page' =>   'require',
        'id' =>     'require|number',
    ];
    protected $scene = [
        'add'  =>  ['title','type','startTime','endTime','nameList'],
        'get'  =>  ['type','page'],
        'delete' => ['id'],
        'partUpdate' => ['id','endTime'],
    ];
}