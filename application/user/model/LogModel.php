<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/7
 * Time: 13:53
 */

namespace app\user\model;

use think\facade\Request;
class LogModel extends BaseModel
{
    protected $table = 'dl_log';
    public function voteLog($data){
        if (count($data) == count($data, 1)){   //相等为一维数组
            return $this->allowField(true)->save($data);
        }else{
            return $this->allowField(true)->saveAll($data);
        }
    }

    public function hasVote(){  //是否已经投票
        $voteId = Request::param('ownerId');
        $user = session(config('token_user'));
        return $this->where(['voteId'=>$voteId,'fromOpenId'=>$user])->find();
    }

    public function getVotePersonNums(){
        $ownerId = Request::param('ownerId');
        return $this->where(['voteId'=>$ownerId])
            ->group('fromOpenId')
            ->count();
    }
}