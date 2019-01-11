<?php
/**
 * Created by PhpStorm.
 * User: grayVTouch
 * Date: 2019/1/10
 * Time: 14:14
 */

namespace app\pay\Controller;


class User extends Controller
{
    // 用户登录
    public function loginView()
    {
        return view();
    }

    // 登录
    public function login()
    {

    }

    // 注销
    public function loginOut()
    {
        session('user' , null);
        setcookie(session_name() , '' , time() - 1 , '/');
        return c_response('000' , '注销成功');
    }
}