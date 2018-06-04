<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/18
 * Time: 13:56
 */

namespace app\v1\controller;
use app\v1\model\Wechat;
use think\Controller;
use EasyWeChat\Factory;

class Index extends Controller
{
    public function index(){
        $openId = (new Wechat())->getOpenidFromCode();
        if (!$openId) return jsonError();
        echo $openId;
    }

    public function test(){
        return 'this is test page';
    }
}