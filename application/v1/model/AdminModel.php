<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/29
 * Time: 15:44
 */

namespace app\v1\model;
use think\Model;
use think\facade\Request;

class AdminModel extends BaseModel
{
    protected $table = 'dl_admin';

    public function adminLogin(){
        $username = Request::param('username');
        $res = $this::where(['username'=>$username])->find();
        print_r($res);
    }
}