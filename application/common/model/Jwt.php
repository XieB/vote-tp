<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/18
 * Time: 14:46
 */

namespace app\common\model;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\ValidationData;
class Jwt
{
    private $signer;
    private $iss = 'fromme';
    private $halt = 'idontknowxiediansha';
    private $timeout = 3600;    //超时时间
    public function __construct()
    {
        $this->signer = new Sha256();
    }

    public function getToken($array = []){
        if (empty($array) || !is_array($array)) return false;
        $token = (new Builder())->setIssuer($this->iss)
            ->setIssuedAt(time())
            ->setExpiration(time() + $this->timeout);
        foreach ($array as $key => $value){
            $token = $token->set($key,$value);
        }
        $token = $token->sign($this->signer, $this->halt)->getToken();

        return (string)$token;  //其实现了__toString方法
    }
    public function verifyToken($tokenString){
        $token = (new Parser())->parse((string) $tokenString);
        if (!$token->verify($this->signer, $this->halt)) {
            return false; //签名不正确
        }
        //验证是否过期
        $data = new ValidationData();
        if (!$token->validate($data)){
            return false;
        }
        return true;
    }
}