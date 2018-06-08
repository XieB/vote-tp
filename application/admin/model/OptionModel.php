<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/6
 * Time: 10:29
 */

namespace app\admin\model;

use think\facade\Request;
class OptionModel extends BaseModel
{
    protected $table = 'dl_option';
    public function addOptions($nameList,$id){
        $data = array_map(function($v) use($id){
            return [
                'name' => $v,
                'ownerId' => $id,
            ];
        },$nameList);
        return $this->allowField(true)->saveAll($data);
    }

    public function deleteOptions(){
        $id = Request::param('id');
        return $this->where(['ownerId'=>$id])->delete();
    }

    public function getOptionsFromVoteId($id){
        return $this->where(['ownerId'=>$id])->column('name');
    }

    public function deleteOption(){
        $name = Request::param('name');
        $ownerId = Request::param('ownerId');
        return $this->where(['name'=>$name,'ownerId'=>$ownerId])->delete();
    }

    public function addOption(){
        $data = Request::param();
        return $this->allowField(true)->save($data);
    }

    public function getResult(){
        $ownerId = Request::param('ownerId');
        $res = $this->where(['ownerId'=>$ownerId])->order('voteNum desc')->select();
        if (!count($res)) return false;
        return $res->toArray();
    }

}