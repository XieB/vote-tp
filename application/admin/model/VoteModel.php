<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/1
 * Time: 11:25
 */

namespace app\admin\model;

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
        $voteRes = $this->allowField(true)->save($data);
        if (!$voteRes) return false;
        $nameList = Request::param('nameList/a');  //强制转换为数组类型
        $optionRes = (new OptionModel())->addOptions($nameList,$this->id);   //添加选项
        if ($optionRes) return true;
        return false;
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
        $where[] = ['b.ownerId','<>',''];

        $res = $this->alias('a')
            ->join('option b','a.id = b.ownerId')
            ->where($where)
            ->group('a.id')
            ->page($page,10)
            ->field('a.*')
            ->order('a.id desc')
            ->select();

        return $res;
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
        $data = $this->where('id',$id)->find();
        if (!$data) return fasle;
        $data['nameList'] = (new OptionModel())->getOptionsFromVoteId($data['id']);
        return $data;
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