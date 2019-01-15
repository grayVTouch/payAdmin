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
use app\pay\model\Route as MRoute;



class Route extends Controller
{
    // 视图：角色列表
    public function listView()
    {
        return $this->fetch('list');
    }

    // 角色列表
    public function list()
    {
        $res = MRoute::paginate();
        return Misc::response('000' , '' , $res);
    }

    // 视图：编辑角色
    public function editView()
    {
        return $this->fetch('route' , [
            'id' => input('id') ,
            'type' => 'edit'
        ]);
    }

    // 视图：添加角色
    public function addView()
    {
        return $this->fetch('route' , [
            'type' => 'add'
        ]);
    }

    // 角色数据
    public function get()
    {
        $id = input('id');
        $res = MRoute::where('id' , $id)->find();
        return Misc::response('000' , '' , $res);
    }

    // 添加角色
    public function add()
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
        $data['weight'] = $data['weight'] ?? config('app.weight');
        $data['p_id'] = $data['p_id'] ?? 0;
        $m = new MRoute();
        $m->allowField([
            'name' ,
            'en' ,
            'module' ,
            'controller' ,
            'action' ,
            'ico_for_font' ,
            'is_menu' ,
            'enable' ,
            'p_id' ,
            'weight' ,
        ])->save($data);
        return Misc::response('000' , '操作成功');
    }

    // 编辑角色
    public function edit()
    {
        $data = request()->post();
        $data['id'] = $data['id'] ?? '';
        if (empty($data['id'])) {
            return Misc::response('002' , 'id 尚未提供');
        }
        $validator = Validate::make([
            'name' => 'require' ,
        ] , [
            'name.require' => '名称尚未提供'
        ]);
        if (!$validator->batch()->check($data)) {
            return Misc::response('001' , '' , $validator->getError());
        }
        $data['weight'] = $data['weight'] ?? config('app.weight');
        $data['p_id'] = $data['p_id'] ?? 0;
        $m = new MRoute();
        $m->allowField([
            'name' ,
            'en' ,
            'module' ,
            'controller' ,
            'action' ,
            'ico_for_font' ,
            'is_menu' ,
            'enable' ,
            'p_id' ,
            'weight' ,
        ])->save($data , [
            'id' => $data['id']
        ]);
        return Misc::response('000' , '操作成功');
    }

    // 删除角色
    public function del()
    {
        $id_list = request()->post('id_list');
        $id_list = empty($id_list) ? [] : json_decode($id_list , true);
        if (empty($id_list)) {
            return Misc::response('002' , '请提供待删除项');
        }
        $res = MRoute::whereIn('id' , $id_list)->delete();
        return Misc::response('000' , '操作成功' , $res);
    }

    // 上传图片
    public function saveImage()
    {
        $data = request()->post();
        $validator = Validate::make([
            'id' => 'require' ,
            'type' => 'require' ,
            'image' => 'require'
        ] , [
            'id.require' => '路由id尚未提供' ,
            'type.require' => '保存类型尚未提供' ,
            'image.require' => '图片尚未提供'
        ]);
        if (!$validator->check($data)) {
            return Misc::response('002' , $validator->getError());
        }
        $column = $type = 'big' ? 'ico_for_big' : 'ico_for_small';
        // 保存到数据库
        MRoute::where('id' , $data['id'])->update([
            $column => $data['image']
        ]);
        return Misc::response('000' , '操作成功');
    }

    // 数据测试
    public function test()
    {
    }
}