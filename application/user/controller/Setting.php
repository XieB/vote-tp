<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/5
 * Time: 9:16
 */

namespace app\user\controller;


use app\common\validate\UserValidate;
use app\user\model\UserModel;

class Setting extends Base
{
    public function updateUserInfo(){
        (new UserValidate())->scene('user')->goCheck();

        $isExamine = (new UserModel())->isExamine();
        if ($isExamine) return jsonError(['info'=>'该账户已经审核通过，无法修改']);

        $res = (new UserModel())->updateUserInfo();

        if ($res !== false) return jsonSuccess();
        return jsonError();
    }

    public function test(){
        return session(config('user_type'));
    }

    public function getUserInfo(){
//        if (session(config('user_type')) == '0'){
//            return 'yes';
//        }else{
//            return 'no';
//        }
        $res = (new UserModel())->getUserInfo();
        if ($res) return jsonSuccess(['data'=>$res]);
        return jsonError();
    }
}