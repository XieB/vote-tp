<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/1
 * Time: 9:27
 */

namespace app\v1\controller;

use app\v1\validate\VoteValidate;
use app\v1\model\VoteModel;
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
}