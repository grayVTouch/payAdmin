<?php
/**
 * Created by PhpStorm.
 * User: grayVTouch
 * Date: 2019/1/12
 * Time: 20:45
 */

namespace app\pay\controller;

use Validate;
use app\pay\util\Misc;
use app\pay\model\BankCode;


class Bank extends Controller
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
        $data['bank_name'] = $data['bank_name'] ?? '';
        $data['bank_code'] = $data['bank_code'] ?? '';
        $data['order'] = isset($data['order']) && !empty($data['order']) ? $data['order'] : 'id|desc';
        $order = explode('|' , $data['order']);
        $where = [];
        if ($data['id'] != '') {
            $where[] = ['id' , '=' , $data['id']];
        }
        if ($data['bank_name'] != '') {
            $where[] = ['bank_name' , 'like' , "%{$data['bank_name']}%"];
        }
        if ($data['bank_code'] != '') {
            $where[] = ['bank_code' , 'like' , "%{$data['bank_code']}%"];
        }
        $res = BankCode::where($where)
            ->order($order[0] , $order[1])
            ->paginate();
        return Misc::response('000' , '' , [
            'data' => $res ,
            'filter' => $data
        ]);
    }

    // 视图：编辑
    public function editView()
    {
        return $this->fetch('bank');
    }

    // 视图：添加
    public function addView()
    {
        return $this->fetch('bank');
    }

    // 功能：数据
    public function get()
    {
        $id = input('id');
        $res = BankCode::where('id' , $id)->find();
        return Misc::response('000' , '' , $res);
    }

    // 功能：添加
    public function add()
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
        $m = new BankCode();
        $m->allowField([
            'bank_name' ,
            'bank_code' ,
            'color'
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
            'bank_name' => 'require' ,
            'bank_code' => 'require' ,
        ] , [
            'bank_name.require' => '银行名称尚未提供' ,
            'bank_code.require' => '银行代码尚未提供'
        ]);
        if (!$validator->batch()->check($data)) {
            return Misc::response('001' , '' , $validator->getError());
        }
        $m = new BankCode();
        $m->allowField([
            'bank_name' ,
            'bank_code' ,
            'color'
        ])->save($data , [
            'id' => $data['id']
        ]);
        return Misc::response('000' , '操作成功' , $m->id);
    }

    // 功能：保存图片
    public function saveImage()
    {
        $data = request()->post();
        $validator = Validate::make([
            'id' => 'require' ,
            'image' => 'require'
        ] , [
            'id.require' => '路由id尚未提供' ,
            'image.require' => '图片尚未提供'
        ]);
        if (!$validator->check($data)) {
            return Misc::response('002' , $validator->getError());
        }
        // 保存到数据库
        BankCode::where('id' , $data['id'])->update([
            'logo' => $data['image']
        ]);
        return Misc::response('000' , '操作成功');
    }

    // 功能：删除
    public function del()
    {
        $id_list = request()->post('id_list');
        $id_list = empty($id_list) ? [] : json_decode($id_list , true);
        if (empty($id_list)) {
            return Misc::response('002' , '请提供待删除项');
        }
        $res = BankCode::whereIn('id' , $id_list)->delete();
        return Misc::response('000' , '操作成功' , $res);
    }
}