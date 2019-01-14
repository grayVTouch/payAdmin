<?php
/**
 * Created by PhpStorm.
 * User: grayVTouch
 * Date: 2019/1/12
 * Time: 20:45
 */

namespace app\pay\controller;

use Exception;
use Validate;
use Db;
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

    // 视图：角色列表
    public function listView()
    {
        return $this->fetch('list');
    }

    // 角色列表
    public function list()
    {
        $res = MRole::paginate();
        return Misc::response('000' , '' , $res);
    }

    // 视图：编辑角色
    public function editView()
    {
        return $this->fetch('role' , [
            'id' => input('id') ,
            'type' => 'edit'
        ]);
    }

    // 角色数据
    public function role()
    {
        $id = input('id');
        $res = MRole::where('id' , $id)->find();
        return Misc::response('000' , '' , $res);
    }

    // 编辑角色
    public function edit()
    {
        $data = request()->post();
        $validator = Validate::make([
            'name' => 'require' ,
        ] , [
            'name.require' => '名称尚未提供'
        ]);
        if (!$validator->batch()->check($data)) {
            return Misc::response('001' , '' , $validator->getError());
        }
        $data['weight'] = isset($data['weight']) ? intval($data['weight']) : config('app.weight');
        $m = new MRole();
        $m->allowField([
            'name' ,
            'code' ,
            'weight' ,
        ])->save($data);
    }

    // 添加角色
    public function add()
    {
        $data = request()->post();
        $validator = Validate::make([
            'id' => 'require' ,
            'name' => 'require' ,
        ] , [
            'id.require' => 'id 尚未提供' ,
            'name.require' => '名称尚未提供'
        ]);
        if (!$validator->batch()->check($data)) {
            return Misc::response('001' , '' , $validator->getError());
        }
        $data['weight'] = isset($data['weight']) ? intval($data['weight']) : config('app.weight');
        $m = new MRole();
        $m->allowField([
            'name' ,
            'code' ,
            'weight' ,
        ])->save($data , [
            'id' => $data['id']
        ]);
    }

    // 删除角色
    public function del()
    {
        $id_list = request()->post('id_list');
        $id_list = empty($id_list) ? [] : json_decode($id_list , true);
        if (empty($id_list)) {
            return Misc::response('002' , '请提供待删除项');
        }
        $res = MRole::whereIn('id' , $id_list)->delete();
        return Misc::response('000' , '操作成功' , $res);
    }
}