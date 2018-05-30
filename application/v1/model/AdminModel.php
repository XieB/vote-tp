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
        $password = Request::param('password');
        $res = $this->where(['username'=>$username])->find();
        if (!$res){
            return false;
        }
        $res = $res->toArray();
        $salt = $res['salt'];
        if (md5($password . $salt) == $res['password']){
            return true;
        }
        return false;
    }
}