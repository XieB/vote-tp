<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/4
 * Time: 11:13
 */

namespace app\common\model;

use think\facade\Request;
class Wechat
{
    private $appId;
    private $appSecret;
    public function __construct()
    {
        $config = config('wechat');
        $this->appId = $config['appID'];
        $this->appSecret = $config['appsecret'];
    }

    public function getOpenidFromCode(){
        $code = Request::param('code');
        $url = $this->getUrlOpenIdFromCode($code);
        $res = file_get_contents($url);
        $res = json_decode($res,true);
        if (isset($res['errcode'])) return false;
        return $res;
    }

    public function getUrlOpenIdFromCode($code){
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='. $this->appId .'&secret='. $this->appSecret .'&code='. $code .'&grant_type=authorization_code';
        return $url;
    }

    public function getUserInfoUrl($accessToken,$openid){
        return 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $accessToken . '&openid=' . $openid . '&lang=zh_CN';
    }

    public function getWxUserInfoFromCode(){
        $code = Request::param('code');
        $url = $this->getUrlOpenIdFromCode($code);
        $res = file_get_contents($url);
        $res = json_decode($res,true);
        if (isset($res['errcode'])) return false;

        $url = $this->getUserInfoUrl($res['access_token'],$res['openid']);
        $res = file_get_contents($url);
        $res = json_decode($res,true);
        if (isset($res['errcode'])) return false;
        return $res;
    }



}