<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/29
 * Time: 15:00
 */

namespace app\common\exception;

/**
 * token异常
 * Class TokenException
 * @package app\common\exception
 */
class TokenException extends BaseException
{
    public $code = 401;
    public $msg = 'token error';
    public $errorCode = 0;
}