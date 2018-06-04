<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/2
 * Time: 10:40
 */

namespace app\v1\controller;


use app\v1\model\AdminModel;
use app\v1\validate\SystemValidate;

class System extends Base
{
    public function resetPass(){
        (new SystemValidate())->scene('resetPass')->goCheck();

        $userInfo = (new AdminModel())->getAdminInfo();
        if (!$userInfo) return jsonSuccess(['info'=>'未找到用户信息']);

        //比对旧密码是否正确
        $data = $this->request->param();
        if ((createPass($data['oldPass'],$userInfo['salt'])) != $userInfo['password']) return jsonError(['info'=>'旧密码错误']);

        //比对重复密码是否一致
        if ($data['newPass'] != $data['reNewPass']) return jsonError(['info'=>'重复密码不一致']);

        if(!(new AdminModel())->resetPass()) return jsonError(['info'=>'修改失败']);
        return jsonSuccess();

    }
}