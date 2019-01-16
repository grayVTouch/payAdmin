<?php
/**
 * Created by PhpStorm.
 * User: grayVTouch
 * Date: 2019/1/16
 * Time: 15:32
 */

namespace app\pay\util;


class User
{
    public static function loginOut()
    {
        session('user' , null);
        setcookie(session_name() , '' , time() - 1 , '/');
    }
}