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

    /**
     * 添加投票
     */
    public function addVote(){
        $data = Request::param();
        return $this->allowField(true)->save($data);
    }

    /**
     * 获取列表
     */
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

    /**
     * 删除信息
     * @return int
     */
    public function deleteVote(){
        $id = Request::param('id');
//        return $this->delete($id);
        return $this->where('id',$id)->delete();
    }

    /**
     * 获取一条信息
     */
    public function getOneVote(){
        $id = Request::param('id');
        return $this->where('id',$id)->find();
    }

    public function allUpdate(){
        $data = Request::param();
        $id = $data['id'];
        return $this->allowField(true)->save($data,['id'=>$id]);
    }

    public function partUpdate(){
        $data = Request::param();
        $endTime = $data['endTime'];
        $id = $data['id'];
        return $this->allowField(true)->save(['endTime'=>$endTime],['id'=>$id]);
    }
}