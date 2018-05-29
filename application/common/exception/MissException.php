<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/29
 * Time: 14:59
 */

namespace app\common\exception;

/**
 * 404时抛出此异常
 */
class MissException extends BaseException
{
    public $code = 200;
    public $msg = 'global:your required resource are not found';
    public $errorCode = 0;
}