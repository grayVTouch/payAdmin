<?php
/**
 * Created by PhpStorm.
 * User: grayVTouch
 * Date: 2019/1/10
 * Time: 14:14
 */

namespace app\pay\Controller;

use app\common\util\Hash;
use app\pay\model\User as MUser;
use app\pay\util\Misc;

class User extends Controller
{
    // 注销
    public function loginOut()
    {
        session('user' , null);
        setcookie(session_name() , '' , time() - 1 , '/');
        return Misc::response('000' , '注销成功');
    }

    /**
     * @title
     * @author cxl
     */
    public function add()
    {
        $data = [
            'phone' => '13375086826' ,
            'password' => Hash::generate('123456')
        ];
        $user = new MUser();
        $user->allowField([
            'phone' ,
            'password'
        ])->save($data);
        return Misc::response('000' , '添加用户成功');
    }

    // 用户列表
    public function listView()
    {
        return $this->fetch('list');
    }
}