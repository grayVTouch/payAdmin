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
use app\pay\util\User as UUser;

class User extends Controller
{
    // 注销
    public function loginOut()
    {
        UUser::loginOut();
        return Misc::response('000' , '注销成功');
    }

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

    // 视图：用户列表
    public function listView()
    {
        return $this->fetch('list');
    }

    // 数据：列表
    public function list()
    {
        $data = request()->post();
        $data['uid']     = $data['uid'] ?? '';
        $data['order'] = isset($data['order']) && !empty($data['order']) ? $data['order'] : 'uid|desc';
        $order = explode('|' , $data['order']);
        $where = [];
        if ($data['uid'] != '') {
            $where[] = ['uid' , '=' , $data['uid']];
        }
        $res = MUser::with('role')
            ->where($where)
            ->order($order[0] , $order[1])
            ->paginate()
            ->each(function($v){
                MUser::single($v);
            });
        return Misc::response('000' , '' , [
            'data' => $res ,
            'filter' => $data ,
        ]);
    }
}