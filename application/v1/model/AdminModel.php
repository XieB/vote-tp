<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/29
 * Time: 15:44
 */

namespace app\v1\model;
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
        if ((createPass($password,$salt)) == $res['password']){
            return true;
        }
        return false;
    }

    public function resetPass(){
        $data = Request::param();

        $res = $this->getAdminInfo();
        $newPass = createPass($data['newPass'],$res['salt']);

        return $this->save(['password'=>$newPass],['username'=>session('admin_user')]);
    }

    public function getAdminInfo(){
        return $this->where(['username'=>session('admin_user')])->find();
    }
}