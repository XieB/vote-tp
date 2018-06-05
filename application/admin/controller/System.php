<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/2
 * Time: 10:40
 */

namespace app\admin\controller;


use app\admin\model\AdminModel;
use app\admin\model\UserModel;
use app\common\validate\SystemValidate;

class System extends Base
{
    public function resetPass(){
        (new SystemValidate())->scene('resetPass')->goCheck();

        $userInfo = (new AdminModel())->getAdminInfo();
        if (!$userInfo) return jsonError(['info'=>'未找到用户信息']);

        //比对旧密码是否正确
        $data = $this->request->param();
        if ((createPass($data['oldPass'],$userInfo['salt'])) != $userInfo['password']) return jsonError(['info'=>'旧密码错误']);

        //比对重复密码是否一致
        if ($data['newPass'] != $data['reNewPass']) return jsonError(['info'=>'重复密码不一致']);

        if(!(new AdminModel())->resetPass()) return jsonError(['info'=>'修改失败']);
        return jsonSuccess();

    }

    public function getNoExamine(){
        (new SystemValidate())->scene('isExamine')->goCheck();
        $res = (new UserModel())->getUserNoExamine();
        if (count($res)) return jsonSuccess(['data'=>$res]);
        return jsonError();
    }

    public function getExamine(){
        (new SystemValidate())->scene('isExamine')->goCheck();

        $res = (new UserModel())->getUserExamine();

        if (count($res)) return jsonSuccess(['data'=>$res]);
        return jsonError();
    }

    public function deleteMember(){
        (new SystemValidate())->scene('examineSuccess')->goCheck();

        $res = (new UserModel())->deleteUser();
        if ($res) return jsonSuccess();
        return jsonError();
    }

    public function examineSuccess(){
        (new SystemValidate())->scene('examineSuccess')->goCheck();

        $res = (new UserModel())->examineSuccess();
        if ($res !== false) return jsonSuccess();
        return jsonError();
    }
}