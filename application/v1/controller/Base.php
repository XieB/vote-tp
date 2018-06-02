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
use app\common\exception\TokenException;
use Lcobucci\JWT\Parser;

class Base extends Controller
{
    public function initialize()
    {
        $this->checkToken();
        parent::initialize(); // TODO: Change the autogenerated stub
    }

    private function checkToken(){
        //或许放到行为里更合适?但是貌似行为不支持分模块
        //获取前端头部传递过来的token
        $token = $this->request->server('HTTP_AUTHORIZATION');
        $res = (new Jwt())->verifyToken($token);
        //如果前端传过来的token不合规范，会有异常抛出（500状态码），暂时不处理吧
        if (!$res){     //验证失败，返回401状态码
            throw new TokenException(); //token错误异常
        }
        $this->regAdminUser($token);
    }

    public function regAdminUser($str){
        $token = (new Parser())->parse((string) $str);
        $user = $token->getClaim('user');
        session('admin_user',$user);  //注册session用来获取当前用户
    }
}