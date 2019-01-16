<?php
/**
 * Created by PhpStorm.
 * User: grayVTouch
 * Date: 2019/1/11
 * Time: 14:07
 */

namespace app\pay\controller;



class Permission extends Controller
{
    protected $middleware = [];

    // 无权限
    public function denyView()
    {
        return view('deny');
    }


}