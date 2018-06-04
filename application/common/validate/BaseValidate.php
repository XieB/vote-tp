<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/29
 * Time: 14:26
 */

namespace app\common\validate;
use think\Validate;
use think\facade\Request;
use app\common\exception\ParameterException;


class BaseValidate extends Validate
{
    //开启批量验证
    protected $batch=true;
    public function goCheck($rule=[]){

        $request=Request::instance();
        $params=$request->param();

        if(!$this->check($params,$rule)){
            $exception = new ParameterException(
                [
                    // $this->error有一个问题，并不是一定返回数组，需要判断
                    'info' => is_array($this->error) ? implode(
                        ';', $this->error) : $this->error,
                ]);

            throw $exception;

        }
    }
}