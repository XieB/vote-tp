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
        $tokenArray = [
            config('token_admin') => $username,
        ];

        $token = (new Jwt())->getToken($tokenArray);
        return jsonSuccess(['data'=>$token]);
    }
    public function loginFromOpenId(){
        (new WechatValidate())->goCheck();

        $code = $this->request->param('code');  //获取从前端传过来的code，并得到该用户openid
        $scope = $this->request->param('scope');

        if ($scope == 'snsapi_base'){
            $userInfo = (new Wechat())->getOpenidFromCode($code);
        }elseif ($scope == 'snsapi_userinfo'){
            $userInfo = (new Wechat())->getWxUserInfoFromCode($code);
        }
//        if (!$openId) return jsonError();
        if (!$userInfo) return jsonError();
        $openId = $userInfo['openid'];

        //塞进token一些自定义信息
        $tokenArray = [
            config('token_user') => $openId,
        ];
        //插入新纪录或取出记录,并写入session
//        $res = (new UserModel())->checkUserFromOpenid($openId); //$res 表示是否已经审核
        $res = (new UserModel())->checkUser($userInfo); //$res 表示是否已经审核

        if ($res){
            $tokenArray[config('user_type')] = '1';
        }else{
            $tokenArray[config('user_type')] = '0';
        }

        $token = (new Jwt())->getToken($tokenArray);
        $data = [
            'isExamine' => $res,    //是否审核，用以跳转不同页面
            'token' => $token,
        ];
        return jsonSuccess(['data'=>$data]);
    }
    public function test(){
        return json('aaa');
    }
}