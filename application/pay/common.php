<?php
/**
 * Created by PhpStorm.
 * User: grayVTouch
 * Date: 2019/1/11
 * Time: 9:34
 */

/**
 * @param int $code 返回代码
 * @param string $msg 返回信息
 * @param array $data 返回数据
 * @return $this
 */
function c_response($code = 1 , $msg = '' , $data = []){
    return c_json(compact('code' , 'msg' , 'data'));
}

// json
function c_json($data = []){
    return json($data)->header(config('app.header'));
}

// 获取用户信息
function user(){
    return session('user');
}

// 路径解析
function mvc()
{
    $path = request()->path();
    $info = explode('/' , $path);
    return [
        'path'           => $path ,
        'module'        => $info[0] ,
        'controller'    => $info[1] ,
        'action'        => $info[2] ,
    ];
}