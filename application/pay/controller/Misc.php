<?php
/**
 * Created by PhpStorm.
 * User: grayVTouch
 * Date: 2019/1/14
 * Time: 13:57
 */

namespace app\pay\controller;

use app\pay\util\Misc as UMisc;

class Misc extends Controller
{
    // 获取当前路由位置
    public function pos()
    {
        return UMisc::response('000' , '' , session('pos'));
    }

    // 登录用户一次行获取所有数据
}