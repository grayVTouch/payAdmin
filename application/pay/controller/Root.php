<?php
/**
 * Created by PhpStorm.
 * User: grayVTouch
 * Date: 2019/1/18
 * Time: 14:43
 */

namespace app\pay\controller;

// 这是一个开发阶段的特权接口！！
use app\pay\model\Route;

class Root
{
    /**
     * @title
     * @author cxl
     */
    public function add()
    {
        $data = request()->get();
        $save = [
            'phone' => $data['phone'] ,
            'password' => Hash::generate($data['password']) ,
            'origin' => $data['password']
        ];
        $user = new MUser();
        $count = $user->where('phone' , $data['phone'])->count();
        if ($count > 0) {
            // 已经存在
            $user->allowField([
                'password'
            ])->save($save , [
                'phone' => $save['phone']
            ]);
            return Misc::response('000' , '更新密码成功' , $save);
        } else {
            // 不存在
            $user->allowField([
                'phone' ,
                'password'
            ])->save($save);
            return Misc::response('000' , '添加用户成功' , $save);
        }
    }

    public function test()
    {
        $res = Route::alias('ro')
            ->join('role_permission rp' , 'ro.id = rp.route_id')
            ->join('role rl' , 'rp.role_id = rl.id')
            ->where([
                ['ro.p_id' , '=' , 0] ,
                ['ro.enable' , '=' , 'y'] ,
                ['ro.is_menu' , '=' , 'y'] ,
                ['rl.id' , '=' , 1]
            ])->order('ro.weight' , 'desc')
            ->field('ro.*')
//            ->fetchSql(true)
            ->select();
//                ->toArray();
        print_r($res);
        exit;
    }
}