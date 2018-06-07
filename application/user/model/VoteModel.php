<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/7
 * Time: 8:54
 */

namespace app\user\model;


use think\facade\Request;

class VoteModel extends BaseModel
{
    protected $table = 'dl_vote';
    public function getVote(){
        $type = Request::param('type');
        $page = Request::param('page');
        $nowTime = date('Y-m-d H:i:s');
        $where = [];

        switch ($type){ //1已结束，2进行中
            case '1':
                $where[] = ['endTime', '<', $nowTime];
                break;
            case '2':
                $where[] = ['endTime', '>=', $nowTime];
                $where[] = ['startTime', '<=', $nowTime];
                break;
        }
        return $this->where($where)
            ->order('id desc')
            ->page($page,10)
            ->select();

//        $sql = <<<EOF
//select * from (select a.*,b.fromOpenId as bid from dl_vote as a left join dl_log as b on a.id = b.voteId group by a.id HAVING bid !='oNotUs0RXjhJJ1K90_d7HLNVNlVg' or bid is null ORDER BY id desc) t1
//UNION
//select * from (select a.*,b.fromOpenId as bid from dl_vote as a left join dl_log as b on a.id = b.voteId group by a.id HAVING bid = 'oNotUs0RXjhJJ1K90_d7HLNVNlVg' order by id desc) t2
//EOF;

    }
    public function getOneVote(){
        $id = Request::param('id');
        return $this->where(['id'=>$id])->find();
    }
}