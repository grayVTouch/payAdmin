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
        $data = request()->post();
        $data['id']     = $data['id'] ?? '';
        $data['module'] = $data['module'] ?? '';
        $data['controller'] = $data['controller'] ?? '';
        $data['action']  = $data['action'] ?? '';
        $data['is_menu'] = $data['is_menu'] ?? '';
        $data['enable'] = $data['enable'] ?? '';
        $data['p_id'] = $data['p_id'] ?? '';
        $data['order'] = isset($data['order']) && !empty($data['order']) ? $data['order'] : 'id|desc';
        $order = explode('|' , $data['order']);
        $where = [];
        if ($data['id'] != '') {
            $where[] = ['id' , '=' , $data['id']];
        }
        if ($data['name'] != '') {
            $where[] = ['name' , 'like' , "%{$data['name']}%"];
        }
        if ($data['module'] != '') {
            $where[] = ['module' , 'like' , "%{$data['module']}%"];
        }
        if ($data['controller'] != '') {
            $where[] = ['controller' , 'like' , "%{$data['controller']}%"];
        }
        if ($data['action'] != '') {
            $where[] = ['action' , 'like' , "%{$data['action']}%"];
        }
        if ($data['is_menu'] != '') {
            $where[] = ['is_menu' , '=' , $data['is_menu']];
        }
        if ($data['enable'] != '') {
            $where[] = ['enable' , '=' , $data['enable']];
        }
        if ($data['p_id'] != '') {
            $where[] = ['p_id' , '=' , $data['p_id']];
        }
        $res = MRoute::where($where)
            ->order($order[0] , $order[1])
            ->paginate()
            ->each(function($v){
                MRoute::single($v);
            });
        return Misc::response('000' , '' , [
            'filter' => $data ,
            'data' => $res
        ]);
    }

    // 视图：编辑角色
    public function editView()
    {
        return $this->fetch('route');
    }

    // 视图：添加角色
    public function addView()
    {
        return $this->fetch('route');
    }

    // 获取单条记录
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
        return Misc::response('000' , '操作成功' , $m->id);
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
        return Misc::response('000' , '操作成功' , $m->id);
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
        $range = ['big' , 'small'];
        if (!in_array($data['type'] , $range)) {
            return Misc::response('002' , '不支持得保存类型');
        }
        $column = $data['type'] == 'big' ? 'ico_for_big' : 'ico_for_small';
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