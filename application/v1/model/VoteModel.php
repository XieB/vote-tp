<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/1
 * Time: 11:25
 */

namespace app\v1\model;

use think\facade\Request;

class VoteModel extends BaseModel
{
    protected $table = 'dl_vote';
    protected $pk = 'id';

    public function addVote(){
        $data = Request::param();
        return $this->allowField(true)->save($data);
    }

    public function getVote(){
        $type = Request::param('type');
        $page = Request::param('page');
        $where = [];
        $nowTime = date('Y-m-d H:i:s');
        switch ($type){
            case '1':
                $where[] = ['endTime', '<', $nowTime];
                break;
            case '2':
                $where[] = ['endTime', '>=', $nowTime];
                break;
        }

        return $this->where($where)->page($page,10)->select();
    }

    public function deleteVote(){
        $id = Request::param('id');
//        return $this->delete($id);
        return $this->where('id',$id)->delete();
    }

    public function getOneVote(){
        $id = Request::param('id');
        return $this->where('id',$id)->find();
    }
}