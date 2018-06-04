<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/1
 * Time: 9:27
 */

namespace app\admin\controller;

use app\common\validate\VoteValidate;
use app\admin\model\VoteModel;
class Vote extends Base
{
    public function add(){
        (new VoteValidate())->scene('add')->goCheck();    //参数校验

        if ((new VoteModel())->addVote()){
            return jsonSuccess();
        }
        return jsonError();
    }

    public function get(){
        (new VoteValidate())->scene('get')->goCheck();

        $res = (new VoteModel())->getVote();
        if (count($res)){
            return jsonSuccess(['data'=>$res]);
        }
        return jsonError();
    }

    public function delete(){
        (new VoteValidate())->scene('delete')->goCheck();

        $res = (new VoteModel())->deleteVote();

        if ($res !== false){
            return jsonSuccess();
        }
        return jsonError();
    }

    public function getOne(){
        (new VoteValidate())->scene('delete')->goCheck();

        $res = (new VoteModel())->getOneVote();

        if ($res) return jsonSuccess(['data'=>$res]);
        return jsonError();
    }

    public function update(){

        $validate = new VoteValidate();
        $validate->scene('delete')->goCheck();   //校验id是否存在

        $voteOne = (new VoteModel())->getOneVote();
        if (!$voteOne) return jsonError();
        $nowData = time();
        $voteStartTime = strtotime($voteOne['startTime']);
        $voteEndTime = strtotime($voteOne['endTime']);
        if ($voteEndTime <= $nowData) return jsonError(['info'=>'投票已结束']);  //投票已结束

        $model = new VoteModel();
        $res = '';
        if ($voteStartTime <= $nowData){    //投票已开始，可修改到期时间
            $validate->scene('partUpdate')->goCheck();
            $res = $model->partUpdate();
        }else{  //未开始可修改全部内容
            $validate->scene('add')->goCheck();
            $res = $model->allUpdate();
        }
        if ($res !== false) return jsonSuccess();
        return jsonError(['info'=>'修改失败']);
    }
}