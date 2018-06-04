<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/18
 * Time: 13:56
 */

namespace app\admin\controller;
use app\admin\model\Wechat;
use think\Controller;

class Index extends Controller
{
    public function index(){
        echo 'i am admin index';
    }

    public function test(){
        return 'this is test page';
    }
}