<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/4
 * Time: 17:50
 */

namespace app\user\controller;

use think\Controller;
class Index extends Controller
{
    public function index(){
        print_r(config('errorcode.noreview'));
    }
}