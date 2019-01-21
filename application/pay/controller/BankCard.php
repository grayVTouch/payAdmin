<?php
/**
 * Created by PhpStorm.
 * User: grayVTouch
 * Date: 2019/1/21
 * Time: 13:38
 */

namespace app\pay\controller;

use Validate;

use app\pay\util\Misc;
use app\pay\model\BankInfo;
use app\pay\model\BankCode;

class BankCard extends Controller
{

    // 视图：列表
    public function listView()
    {
        return $this->fetch('list');
    }

    // 功能：列表
    public function list()
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
    public function editView()
    {
        return $this->fetch('card');
    }

    // 视图：添加
    public function addView()
    {
        return $this->fetch('card');
    }

    // 功能：数据
    public function get()
    {
        $id = input('id');
        $res = BankInfo::where('id' , $id)->find();
        return Misc::response('000' , '' , $res);
    }

    // 功能：添加
    public function add()
    {
        $data = request()->post();
        $validator = Validate::make([
            'uid'       => 'require' ,
            'card_no'   => 'require' ,
            'bank_code' => 'require' ,
            'user_name' => 'require' ,
            'isdelete'  => 'require' ,
        ] , [
            'uid.require' => '用户id尚未提供' ,
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
    public function edit()
    {
        $data = request()->post();
        $data['id'] = $data['id'] ?? '';
        if (empty($data['id'])) {
            return Misc::response('002' , 'id 尚未提供');
        }
        $validator = Validate::make([
            'uid'       => 'require' ,
            'card_no'   => 'require' ,
            'bank_code' => 'require' ,
            'user_name' => 'require' ,
            'isdelete'  => 'require' ,
        ] , [
            'uid.require'       => '用户id尚未提供' ,
            'bank_code.require' => '银行代码尚未提供' ,
            'card_no.require'   => '卡号尚未提供' ,
            'user_name.require' => '名称尚未提供' ,
            'isdelete.require'  => '是否删除尚未提供'
        ]);
        if (!$validator->batch()->check($data)) {
            return Misc::response('001' , '' , $validator->getError());
        }
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
    public function del()
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