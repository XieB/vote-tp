<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/7
 * Time: 9:49
 */

namespace app\user\model;

use think\facade\Request;
class OptionModel extends BaseModel
{
    protected $table = 'dl_option';
    public function getOptionsFromOwnerId(){
        $ownerId = Request::param('ownerId');

        return $this->where(['ownerId'=>$ownerId])->select();
    }
    public function getDataFormWhere($where){ //检查id与voteId是否对应
        return $this->where($where)->select();
    }

    public function doRadio(){
        $id = Request::param('id');
        $this->where(['id'=>$id])->setInc('voteNum');
    }

    public function doCheckBox(){
        $idList = Request::param('idList/a');
        $this->where(['id'=>$idList])->setInc('voteNum');
    }

    public function getResult(){
        $ownerId = Request::param('ownerId');
        $res = $this->where(['ownerId'=>$ownerId])->order('voteNum desc')->select();
        if (!count($res)) return false;
        return $res->toArray();
    }
}