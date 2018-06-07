<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/7
 * Time: 9:46
 */

namespace app\user\controller;


use app\common\validate\OptionValidate;
use app\user\model\OptionModel;

class Option extends Examine
{
    public function getList(){
        (new OptionValidate())->scene('get')->goCheck();
        $res = (new OptionModel())->getOptionsFromOwnerId();

        if (count($res)) return jsonSuccess(['data'=>$res]);
        return jsonError();
    }
}