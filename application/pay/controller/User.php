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
use app\pay\model\BankInfo;
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
            ->paginate();
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
        $res = BankInfo::where('id' , $id)->find();
        return Misc::response('000' , '' , $res);
    }

    // 功能：添加
    public function addCard()
    {
        $data = request()->post();
        $validator = Validate::make([
            'bank_name' => 'require' ,
            'bank_code' => 'require' ,
        ] , [
            'bank_name.require' => '银行名称尚未提供' ,
            'bank_code.require' => '银行代码尚未提供'
        ]);
        if (!$validator->batch()->check($data)) {
            return Misc::response('001' , '' , $validator->getError());
        }
        $m = new BankInfo();
        $m->allowField([
            'bank_name' ,
            'bank_code' ,
            'color'
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
            'bank_name' => 'require' ,
            'bank_code' => 'require' ,
        ] , [
            'bank_name.require' => '银行名称尚未提供' ,
            'bank_code.require' => '银行代码尚未提供'
        ]);
        if (!$validator->batch()->check($data)) {
            return Misc::response('001' , '' , $validator->getError());
        }
        $m = new BankInfo();
        $m->allowField([
            'bank_name' ,
            'bank_code' ,
            'color'
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
}