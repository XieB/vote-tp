<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/4
 * Time: 15:41
 */

namespace app\user\controller;


class Vote extends Examine
{
    public function getList(){
        echo session('user_type');
    }
}