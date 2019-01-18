<?php
/**
 * Created by PhpStorm.
 * User: grayVTouch
 * Date: 2019/1/12
 * Time: 20:45
 */

namespace app\pay\controller;

use Validate;
use Db;
use Exception;
use app\common\lib\Category;
use app\pay\util\Misc;
use app\pay\model\Route;
use app\pay\model\Role as MRole;
use app\pay\model\RolePermission;


class Role extends Controller
{
    // 角色权限
    public function menu()
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
        $data = request()->post();
        $data['id']     = $data['id'] ?? '';
        $data['name'] = $data['module'] ?? '';
        $data['code'] = $data['controller'] ?? '';
        $data['order'] = isset($data['order']) && !empty($data['order']) ? $data['order'] : 'id|desc';
        $order = explode('|' , $data['order']);
        $where = [];
        if ($data['id'] != '') {
            $where[] = ['id' , '=' , $data['id']];
        }
        if ($data['name'] != '') {
            $where[] = ['name' , 'like' , "%{$data['name']}%"];
        }
        if ($data['code'] != '') {
            $where[] = ['name' , '=' , $data['code']];
        }
        $res = MRole::where($where)
            ->order($order[0] , $order[1])
            ->paginate();
        return Misc::response('000' , '' , [
            'data' => $res ,
            'filter' => $data
        ]);
    }

    // 视图：编辑角色
    public function editView()
    {
        return $this->fetch('role');
    }

    // 视图：添加角色
    public function addView()
    {
        return $this->fetch('role');
    }

    // 角色数据
    public function get()
    {
        $id = input('id');
        $res = MRole::where('id' , $id)->find();
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
        $data['weight'] = isset($data['weight']) ? intval($data['weight']) : config('app.weight');
        $m = new MRole();
        $m->allowField([
            'name' ,
            'code' ,
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
        $data['weight'] = isset($data['weight']) ? intval($data['weight']) : config('app.weight');
        $m = new MRole();
        $m->allowField([
            'name' ,
            'code' ,
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
        $res = MRole::whereIn('id' , $id_list)->delete();
        return Misc::response('000' , '操作成功' , $res);
    }

    // 视图：角色权限
    public function permView()
    {
        $id = input('id');
        return $this->fetch('perm' , compact('id'));
    }

    // 用户权限
    public function perm()
    {
        $id = input('id');
        if (empty($id)) {
            return Misc::response('002' , '角色id尚未提供');
        }
        // 路由列表
        $route  = Route::_all()->toArray();
        $route  = Category::childrens(0 , $route , [
            'id' => 'id' ,
            'pid' => 'p_id'
        ] , false , true);

        // 角色拥有的路由列表
        $perm   = RolePermission::where('role_id' , $id)->select();
        return Misc::response('000' , '' , compact('route' , 'perm'));
    }

    // 用户授权
    public function authorize()
    {
        $data = request()->post();
        $validator = Validate::make([
            'id' => 'require' ,
            'route' => 'require'
        ] , [
            'id.require' => '角色id尚未提供' ,
            'route.require' => '授权的路由列表尚未提供' ,
        ]);
        if (!$validator->check($data)) {
            return Misc::response('002' , $validator->getError());
        }
        $data['route'] = json_decode($data['route']);
        try {
            Db::startTrans();
            // 撤销用户之前的授权
            RolePermission::where('role_id' , $data['id'])->delete();
            // 重新对角色进行授权
            foreach ($data['route'] as $v)
            {
                RolePermission::insert([
                    'role_id'   => $data['id'] ,
                    'route_id'  => $v
                ]);
            }
            Db::commit();
            return Misc::response('000' , '操作成功');
        } catch(Exception $e) {
            Db::rollBack();
            throw $e;
        }
    }


}