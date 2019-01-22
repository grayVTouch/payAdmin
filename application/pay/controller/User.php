<?php
/**
 * Created by PhpStorm.
 * User: grayVTouch
 * Date: 2019/1/10
 * Time: 14:14
 */

namespace app\pay\controller;

use app\common\util\Hash;
use Db;
use Validate;
use Exception;

use app\pay\model\User as MUser;
use app\pay\model\BankInfo;
use app\pay\model\BankCode;
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

    // 视图：用户列表
    public function listView()
    {
        return $this->fetch('list');
    }

    // 视图：添加用户
    public function addView()
    {
        return $this->fetch('user');
    }

    // 视图：编辑用户
    public function editView()
    {
        return $this->fetch('user');
    }

    // 功能：获取数据
    public function get()
    {
        $uid = input('uid');
        $res = MUser::where('uid' , $uid)->find();
        return Misc::response('000' , '' , $res);
    }

    // 功能：添加
    public function add()
    {
        $data = request()->post();
        $validator = Validate::make([
            'username' => 'require' ,
            'phone' => 'require' ,
            'role_id' => 'require' ,
            'password' => 'require'
        ] , [
            'username.require' => '名称尚未提供' ,
            'phone.require' => '名称尚未提供' ,
            'role_id.require' => '角色尚未提供' ,
            'password.require' => '密码尚未提供'
        ]);
        if (!$validator->batch()->check($data)) {
            return Misc::response('001' , '' , $validator->getError());
        }
        // 商户号
        $data['mno'] = random(8 , 'number' , true);
        // 密钥
        $data['key'] = random(32 , 'mixed' , true);
        // 注册 ip
        $data['reg_ip'] = ip2long($_SERVER['REMOTE_ADDR']);
        $data['password'] = Hash::generate($data['password']);
        $m = new MUser();
        $m->allowField([
            'username' ,
            'nick_name' ,
            'phone' ,
            'password' ,
            'role_id' ,
            'isdelete' ,
            'enable' ,
            'mno' ,
            'key' ,
            'reg_ip'
        ])->save($data);
        return Misc::response('000' , '操作成功' , $m->id);
    }

    // 功能：编辑
    public function edit()
    {
        $data = request()->post();
        $data['uid'] = $data['uid'] ?? '';
        if (empty($data['uid'])) {
            return Misc::response('002' , 'uid 尚未提供');
        }
        $validator = Validate::make([
            'username' => 'require' ,
            'phone' => 'require' ,
            'role_id' => 'require' ,
        ] , [
            'username.require' => '名称尚未提供' ,
            'phone.require' => '名称尚未提供' ,
            'role_id.require' => '角色尚未提供' ,
        ]);
        if (!$validator->batch()->check($data)) {
            return Misc::response('001' , '' , $validator->getError());
        }
        $m = MUser::where('uid' , $data['uid'])->find();
        // 关于密码，如果提供了密码，重新生成；否则，使用原始密码
        $data['password'] = empty($data['password']) ? $m->password : Hash::generate($data['password']);
        $m->allowField([
            'username' ,
            'nick_name' ,
            'phone' ,
            'password' ,
            'role_id' ,
            'isdelete' ,
            'enable'
        ])->save($data , [
            'uid' => $data['uid']
        ]);
        return Misc::response('000' , '操作成功' , $m->uid);
    }

    // 功能：保存头像
    public function saveImage()
    {
        $data = request()->post();
        $validator = Validate::make([
            'uid' => 'require' ,
            'image' => 'require'
        ] , [
            'uid.require' => '用户id尚未提供' ,
            'image.require' => '图片尚未提供'
        ]);
        if (!$validator->check($data)) {
            return Misc::response('002' , $validator->getError());
        }
        // 保存到数据库
        MUser::where('uid' , $data['uid'])->update([
            'avatar' => $data['image']
        ]);
        return Misc::response('000' , '操作成功');
    }

    // 功能：删除角色
    public function del()
    {
        $id_list = request()->post('id_list');
        $id_list = empty($id_list) ? [] : json_decode($id_list , true);
        if (empty($id_list)) {
            return Misc::response('002' , '请提供待删除项');
        }
        try {
            Db::startTrans();

            // 检查是否包含超级管理员
            $count = MUser::whereIn('uid' , $id_list)
                ->where('is_root' , '=' , 'y')
                ->lock('for share')
                ->count();
            if ($count > 0) {
                // 开启了锁，则必须提交
                Db::commit();
                return Misc::response('002' , '待删除用户中包含超级管理员！！禁止操作');
            }
            $res = MUser::whereIn('uid' , $id_list)
                ->where('is_root' , '!=' , 'y')
                ->delete();
            Db::commit();
            return Misc::response('000' , '操作成功' , $res);
        } catch(Exception $e) {
            Db::rollBack();
            throw $e;
        }
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

    // 视图：列表
    public function cardView()
    {
        return $this->fetch('cards');
    }

    // 功能：列表
    public function card()
    {
        $data = request()->post();
        $data['id']     = $data['id'] ?? '';
        $data['order'] = isset($data['order']) && !empty($data['order']) ? $data['order'] : 'id|desc';
        $order = explode('|' , $data['order']);
        $where = [
            ['uid' , '=' , Misc::user()->uid]
        ];
        if ($data['id'] != '') {
            $where[] = ['id' , '=' , $data['id']];
        }
        $res = BankInfo::where($where)
            ->order($order[0] , $order[1])
            ->paginate()
            ->each(function($m){
                BankInfo::single($m);
            });
        return Misc::response('000' , '' , [
            'data' => $res ,
            'filter' => $data
        ]);
    }

    // 视图：编辑
    public function editCardView()
    {
        return $this->fetch('card');
    }

    // 视图：添加
    public function addCardView()
    {
        return $this->fetch('card');
    }

    // 功能：数据
    public function getCard()
    {
        $id = input('id');
        $res = BankInfo::where('id' , $id)
            ->find();
        return Misc::response('000' , '' , $res);
    }

    // 功能：添加
    public function addCard()
    {
        $data = request()->post();
        $validator = Validate::make([
            'card_no' => 'require' ,
            'bank_code' => 'require' ,
            'user_name' => 'require' ,
            'isdelete' => 'require' ,
        ] , [
            'card_no.require' => '卡号尚未提供' ,
            'bank_code.require' => '银行代码尚未提供' ,
            'user_name.require' => '名称尚未提供' ,
            'isdelete.require' => '是否删除尚未提供' ,
        ]);
        if (!$validator->batch()->check($data)) {
            return Misc::response('001' , '' , $validator->getError());
        }
        $data['uid'] = Misc::user()->uid;
        $bank_code = BankCode::where('bank_code' , $data['bank_code'])->find();
        $data['bank_name'] = $bank_code->bank_name;
        $m = new BankInfo();
        $m->allowField([
            'uid' ,
            'bank_name' ,
            'bank_code' ,
            'card_no' ,
            'user_name' ,
            'isdelete'
        ])->save($data);
        return Misc::response('000' , '操作成功' , $m->id);
    }

    // 功能：编辑
    public function editCard()
    {
        $data = request()->post();
        $data['id'] = $data['id'] ?? '';
        if (empty($data['id'])) {
            return Misc::response('002' , 'id 尚未提供');
        }
        $validator = Validate::make([
            'bank_code' => 'require' ,
            'card_no' => 'require' ,
            'user_name' => 'require' ,
            'isdelete' => 'require' ,
        ] , [
            'bank_code.require' => '银行代码尚未提供' ,
            'card_no.require' => '卡号尚未提供' ,
            'user_name.require' => '名称尚未提供' ,
            'isdelete.require' => '是否删除尚未提供'
        ]);
        if (!$validator->batch()->check($data)) {
            return Misc::response('001' , '' , $validator->getError());
        }
        $data['uid'] = Misc::user()->uid;
        $bank_code = BankCode::where('bank_code' , $data['bank_code'])->find();
        $data['bank_name'] = $bank_code->bank_name;
        $m = new BankInfo();
        $m->allowField([
            'uid' ,
            'bank_name' ,
            'bank_code' ,
            'user_name' ,
            'isdelete' ,
            'card_no'
        ])->save($data , [
            'id' => $data['id']
        ]);
        return Misc::response('000' , '操作成功' , $m->id);
    }

    // 功能：删除
    public function delCard()
    {
        $id_list = request()->post('id_list');
        $id_list = empty($id_list) ? [] : json_decode($id_list , true);
        if (empty($id_list)) {
            return Misc::response('002' , '请提供待删除项');
        }
        $res = BankInfo::whereIn('id' , $id_list)->delete();
        return Misc::response('000' , '操作成功' , $res);
    }

    // 获取登录用户数据
    public function user()
    {
        return Misc::response('000' , '' , Misc::user());
    }
}