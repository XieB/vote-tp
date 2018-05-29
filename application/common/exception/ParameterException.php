<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/29
 * Time: 15:01
 */

namespace app\common\exception;

/**
 * 参数异常
 * Class ParameterException
 * @package app\common\exception
 */
class ParameterException extends BaseException
{
    public $code = 200;
    public $errorCode = 0;
    public $msg = "invalid parameters";
}