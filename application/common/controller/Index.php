<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/4
 * Time: 15:08
 */

namespace app\common\controller;
use think\Controller;

class Index extends Controller
{
    public function index(){
        echo 'this is common index';
    }
}