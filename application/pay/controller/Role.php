<?php
/**
 * Created by PhpStorm.
 * User: grayVTouch
 * Date: 2019/1/12
 * Time: 20:45
 */

namespace app\pay\controller;

use app\pay\util\Misc;
use app\pay\model\Role as MRole;

class Role extends Controller
{
    // 角色权限
    public function perms()
    {
        $menu = Misc::menu();
        return Misc::response('000' , '' , $menu);
    }

    // 角色列表
    public function listView()
    {
        $res = MRole::paginate();
        return $this->fetch('list' , [
            'res' => $res
        ]);
    }
}