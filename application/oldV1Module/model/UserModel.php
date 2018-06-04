<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/4
 * Time: 13:34
 */

namespace app\v1\model;


class UserModel extends BaseModel
{
    protected $table = 'dl_user';
    public function checkUserFromOpenid($openid){
        $res = $this->where(['openid'=>$openid])->find();
        if (!$res) $this->addNewUser($openid);
    }

    public function addNewUser($openid){
        $data = [
            'openid' => $openid,
        ];
        $this->save($data);
    }
}