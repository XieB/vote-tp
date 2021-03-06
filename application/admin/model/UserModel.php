<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/5
 * Time: 9:07
 */

namespace app\admin\model;
use think\facade\Request;

class UserModel extends BaseModel
{
    protected $table = 'dl_user';

    /**
     * @param $type 类型，0未审核，1已审核
     */
    public function getUserNoExamine(){
        $page = Request::param('page');
        $where = [
            ['examine','=','0'],
            ['realName','<>',''],
            ['mobile','<>','']
        ];
        return $this->where($where)->page($page,10)->order('id desc')->select();
    }

    public function getUserExamine(){
        $page = Request::param('page');
        return $this->where(['examine'=>'1'])->page($page,10)->order('id asc')->select();
    }

    public function examineSuccess(){
        $id = Request::param('id');
        $data = ['examine'=>'1'];
        return $this->save($data,['id'=>$id]);
    }

    public function deleteUser(){
        $id = Request::param('id');
        return $this->where(['id'=>$id])->delete();
    }

    public function oneUserInfo(){
        $id = Request::param('id');
        return $this->where(['id'=>$id])->find();
    }
}