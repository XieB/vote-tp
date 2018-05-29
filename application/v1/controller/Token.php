<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/18
 * Time: 13:58
 */

namespace app\v1\controller;
use app\v1\model\Jwt;
use think\Controller;
use app\v1\validate\TokenValidate;
use app\v1\model\AdminModel;

class Token extends Controller
{
    public function loginFromUserPassword(){

        (new TokenValidate())->scene('user')->goCheck();
        //登录逻辑
        (new AdminModel())->adminLogin();
        exit();

        //如果登录成功
        return (new Jwt())->getToken($this->request->param('username'));
    }
    public function loginFromOpenId($openId){
        $code = $this->request->param('code');  //获取从前端传过来的code，并得到该用户openid
        //得到用户openid逻辑

        $openId = '';

        return (new Jwt())->getToken($openId);
    }
    public function test(){
        return json('aaa');
    }
}