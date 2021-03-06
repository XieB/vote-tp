<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/4
 * Time: 15:17
 */

namespace app\user\controller;
use app\common\exception\TokenException;
use think\Controller;
use app\common\exception\UserTokenException;
use app\common\model\Jwt;
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
        if (!$token) throw new TokenException();
        $res = (new Jwt())->verifyToken($token);
        //如果前端传过来的token不合规范，会有异常抛出（500状态码），暂时不处理吧
        if (!$res){     //验证失败，返回401状态码
            throw new UserTokenException();
        }
        $this->regNormalUser($token);
    }

    public function regNormalUser($str){
        $name = config('token_user');
        $typeName = config('user_type');
        $token = (new Parser())->parse((string) $str);
        $user = $token->getClaim($name);
        $type = $token->getClaim($typeName);
        session($name,$user);  //注册session用来获取当前用户,方便不同代码共享数据
        session($typeName,$type);   //审核状态，0未审核，1已审核
    }
}