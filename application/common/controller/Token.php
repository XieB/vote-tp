<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/18
 * Time: 13:58
 */

namespace app\common\controller;
use app\common\model\Jwt;
use app\common\validate\WechatValidate;
use app\user\model\UserModel;
use think\Controller;
use app\common\validate\TokenValidate;
use app\admin\model\AdminModel;
use app\common\model\Wechat;

class Token extends Controller
{
    public function loginFromUserPassword(){


        (new TokenValidate())->scene('user')->goCheck();
        //登录逻辑

        if (!(new AdminModel())->adminLogin()){
            returnError(['info'=>'账户或密码错误!']);
        }

        $username = $this->request->param('username');
        //如果登录成功
        $token = (new Jwt())->getToken($username,config('token_admin'));
        return jsonSuccess(['data'=>$token]);
    }
    public function loginFromOpenId(){
        (new WechatValidate())->goCheck();

        $code = $this->request->param('code');  //获取从前端传过来的code，并得到该用户openid
        //得到用户openid逻辑
        $openId = (new Wechat())->getOpenidFromCode($code);
        if (!$openId) return jsonError();

        //插入新纪录
        (new UserModel())->checkUserFromOpenid($openId);
        session(config('token_user'),$openId);

        $token = (new Jwt())->getToken($openId,config('token_user'));
        return jsonSuccess(['data'=>$token]);
    }
    public function test(){
        return json('aaa');
    }
}