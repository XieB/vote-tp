<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/8
 * Time: 9:55
 */

namespace app\admin\model;

use think\facade\Request;
class LogModel extends BaseModel
{
    protected $table = 'dl_log';
    public function getVotePersonNums(){
        $ownerId = Request::param('ownerId');
        return $this->where(['voteId'=>$ownerId])
            ->group('fromOpenId')
            ->count();
    }
}