<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/29
 * Time: 14:57
 */

namespace app\common\exception;
use think\Exception;

class BaseException extends Exception
{
    public $code=200;
    public $msg='invalid parameters';
    public $errorCode=0;
    public function __construct($params=[]){
        if(!is_array($params)){
            return ;
        }

        if(array_key_exists('code', $params)){
            $this->code=$params['code'];
        }
        if(array_key_exists('info', $params)){
            $this->msg=$params['info'];
        }
        if(array_key_exists('status', $params)){
            $this->errorCode=$params['status'];
        }
    }

}