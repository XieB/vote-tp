<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/4
 * Time: 15:41
 */

namespace app\user\controller;


use app\common\validate\OptionValidate;
use app\common\validate\VoteValidate;
use app\user\model\LogModel;
use app\user\model\OptionModel;
use app\user\model\VoteModel;

class Vote extends Examine
{
    public function getList(){
        (new VoteValidate())->scene('get')->goCheck();

        $res = (new VoteModel())->getVote();

        if (count($res)) return jsonSuccess(['data'=>$res]);
        return jsonError();
    }

    public function getOne(){
        (new VoteValidate())->scene('delete')->goCheck();

        $res = (new VoteModel())->getOneVote();
        if ($res) return jsonSuccess(['data'=>$res]);
        return jsonError();
    }

    public function doRadio(){
        (new VoteValidate())->scene('radio')->goCheck();
        $res = (new LogModel())->hasVote();
        if ($res) return jsonError(['info'=>'您已经投过票了']);
        $id = $this->request->param('id');
        $voteId = $this->request->param('ownerId');
        $where = ['id'=>$id,'ownerId'=>$voteId];
        $res = (new OptionModel())->getDataFormWhere($where);   //检测id与voteid是否对应
        if (!count($res)) return jsonError(['info'=>'参数错误']);

        (new OptionModel())->doRadio(); //添加票数

        $data = ['toOptionId'=>$id,'voteId'=>$voteId,'fromOpenId'=>session(config('token_user'))];
        $res = (new LogModel())->voteLog($data);
        if (!$res) return jsonError(['info'=>'投票失败']);
        return jsonSuccess();
    }

    public function doCheckbox(){
        (new VoteValidate())->scene('checkbox')->goCheck();
        $res = (new LogModel())->hasVote();
        if ($res) return jsonError(['info'=>'您已经投过票了']);

        $idList = $this->request->param('idList/a');
        $voteId = $this->request->param('ownerId');
        $where = ['id'=>$idList,'ownerId'=>$voteId];
        $res = (new OptionModel())->getDataFormWhere($where);
        if (count($idList) != count($res)) return jsonError(['info'=>'参数错误']);

        (new OptionModel())->doCheckBox(); //添加票数

        $data = array_map(function($v) use($voteId){
            return [
                'toOptionId'=>$v,
                'voteId'=>$voteId,
                'fromOpenId'=>session(config('token_user'))
            ];
        },$idList);
        $res = (new LogModel())->voteLog($data);
        if (!$res) return jsonError(['info'=>'投票失败']);
        return jsonSuccess();
    }

    public function hasVote(){
        $res = (new LogModel())->hasVote();
        if (!$res) return jsonSuccess();    //未投票返回成功
        return jsonError(); //已投票返回失败
    }

    public function voteResult(){
        (new OptionValidate())->scene('get')->goCheck();
        $res = (new OptionModel())->getResult();
        if (!$res) return jsonError(['info'=>'没有找到该记录']);
        $sum = 0;
        array_map(function($v) use(&$sum){
            $sum += $v['voteNum'];
        },$res);
        foreach ($res as $key => $v){
            $res[$key]['percentage'] = intval($v['voteNum'] / $sum * 100);
        }
        return jsonSuccess(['data'=>$res]);
    }

    public function votePersonNums(){
        (new OptionValidate())->scene('get')->goCheck();
        $res = (new LogModel())->getVotePersonNums();
        return jsonSuccess(['data'=>$res]);
    }

    public function test(){
        $arr = ['12','23'];
        $arr2 = [['12'],['23']];
        echo count($arr2);
    }
}