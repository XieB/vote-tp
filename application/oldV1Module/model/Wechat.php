<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/4
 * Time: 11:13
 */

namespace app\v1\model;

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

    public function getOpenidFromCode($code){
        $url = $this->getUrlOpenIdFromCode($code);
        $res = file_get_contents($url);
        $res = json_decode($res,true);
        if (isset($res['errcode'])) return false;
        return $res['openid'];
    }

    public function getUrlOpenIdFromCode($code){
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='. $this->appId .'&secret='. $this->appSecret .'&code='. $code .'&grant_type=authorization_code';
        return $url;
    }
}