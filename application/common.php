<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

function returnError($param,$action='Miss'){
    $name='\\app\common\\exception\\'.$action.'Exception';

    throw new $name($param);

}

function jsonSuccess($params=[]){
    if(!is_array($params)){
        return ;
    }

    $result['data']=array_key_exists('data', $params)?$params['data']:[];
    $result['info']=array_key_exists('info', $params)?$params['info']:'ok';
    $result['status']=array_key_exists('status', $params)?$params['status']:1;

    return json($result);
}

function jsonError($params=[]){
    if(!is_array($params)){
        return ;
    }

    $result['data']=array_key_exists('data', $params)?$params['data']:[];
    $result['info']=array_key_exists('info', $params)?$params['info']:'error';
    $result['status']=array_key_exists('status', $params)?$params['status']:0;

    return json($result);
}

function createPass($passText,$salt){
    return md5($passText . $salt);
}