<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/4
 * Time: 13:34
 */

namespace app\user\model;

use think\facade\Request;
class UserModel extends BaseModel
{
    protected $table = 'dl_user';
    public function checkUserFromOpenid($openid){
        session(config('token_user'),$openid);
        $res = $this->where(['openid'=>$openid])->find();
        if (!$res) $this->addNewUser($openid);
        if (!$res['examine']){
            session(config('user_type'),'0');
            return false;
        }
        session(config('user_type'),'1');
        return true;
    }

    public function checkUser($userInfo){
        $openId = $userInfo['openid'];
        session(config('token_user'),$openId);
        $res = $this->where(['openid'=>$openId])->find();
        if (!$res) {
            $this->addNewUser($userInfo);   //添加新纪录
        }else{
            $this->updateWxUserInfo($userInfo); //更新信息
        }
        if (!$res['examine']){
            session(config('user_type'),'0');
            return false;
        }
        session(config('user_type'),'1');
        return true;
    }

    public function addNewUser($userInfo){
//        $data = [
//            'openid' => $openid,
//        ];
        $this->allowField(true)->save($userInfo);
    }

    public function updateWxUserInfo($userInfo){    //获取的信息貌似有延迟
        $this->allowField(true)->save($userInfo,['openid'=>$userInfo['openid']]);
    }

    public function updateUserInfo(){
        $data = Request::param();
        return $this->allowField(true)->save($data,['openid' => session(config('token_user'))]);
    }

    public function getUserInfo(){
        return $this->where(['openid'=>session(config('token_user'))])->find();
    }

    public function isExamine(){    //资料是否审核
        return $this->where(['openid'=>session(config('token_user'))])->value('examine');
    }
}