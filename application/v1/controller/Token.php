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

class Token extends Controller
{
    public function loginFromUserPassword(){

        $data = $this->request->param();
        $rule = [
            'username'  =>  'require',
            'password' =>  'require',
        ];
        $result = $this->validate($data,$rule);
        if (true !== $result){
            return json($result);
        }
        //登录逻辑
        
        //如果登录成功
        return (new Jwt())->getToken($data['username']);
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