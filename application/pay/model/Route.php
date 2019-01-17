<?php
/**
 * Created by PhpStorm.
 * User: grayVTouch
 * Date: 2019/1/12
 * Time: 20:25
 */

namespace app\pay\model;

use app\pay\util\Misc;
use Exception;

use think\Model as BaseModel;
use think\Model\Collection;

class Route extends BaseModel implements Model
{
    public function role()
    {
        return $this->belongsToMany(Role::class , 'role_permission' , 'role_id' , 'route_id');
    }

    // 获取菜单项
    public static function menu($role_id)
    {
        $get = function($route_id , array &$res = []) use(&$get , $role_id){
            static $count = 0;
            if ($count++ > 100) {
                throw new Exception('死循环');
            }
            $res = self::alias('ro')
                ->join('role_permission rp' , 'ro.id = rp.route_id')
                ->join('role rl' , 'rp.role_id = rl.id')
                ->where([
                    ['ro.p_id' , '=' , $route_id] ,
                    ['ro.enable' , '=' , 'y'] ,
                    ['ro.is_menu' , '=' , 'y'] ,
                    ['rl.id' , '=' , $role_id]
                ])->order('ro.weight' , 'desc')
                ->field('ro.*')
                ->select()
                ->toArray();
            foreach ($res as &$v)
            {
                // 新增属性
                $v['link'] = self::url($v['module'] , $v['controller'] , $v['action']);
                $v['children'] = [];
                $get($v['id'] , $v['children']);
            }
            return $res;
        };
        return  $get(0);
    }

    // 获取所有菜单项（超级管理员特权！）
    public static function menus()
    {
        $get = function($route_id , array &$res = []) use(&$get){
            static $count = 0;
            if ($count++ > 100) {
                throw new Exception('死循环');
            }
            $res = self::where([
                    ['p_id' , '=' , $route_id] ,
                    ['enable' , '=' , 'y'] ,
                    ['is_menu' , '=' , 'y'] ,
                ])->order('weight' , 'desc')
                ->field('*')
                ->select()
                ->toArray();
            foreach ($res as &$v)
            {
                // 新增属性
                $v['link'] = self::url($v['module'] , $v['controller'] , $v['action']);
                $v['children'] = [];
                $get($v['id'] , $v['children']);
            }
            return $res;
        };
        return  $get(0);
    }

    // 所有记录
    public static function _all()
    {
        $res = self::select()->each(function($v){
            $v->link = self::url($v->module , $v->controller , $v->action);
        });
        self::multiple($res);
        return $res;
    }

    // 生成链接
    private static function url($m , $c , $a)
    {
        return $m == '' || $c == '' || $a == '' ? '' : Misc::genUrl($m , $c , $a);
    }

    // 单条：数据处理
    public static function single(BaseModel $m = null)
    {
        if (is_null($m)) {
            return ;
        }
        // 是否菜单
        $m->is_menu_explain = Misc::mapVal('business.bool' , $m->is_menu);
        // 是否启用
        $m->enable_explain = Misc::mapVal('business.bool' , $m->enable);
    }

    // 多条：数据处理
    public static function multiple(Collection $collection)
    {
        foreach ($collection as $v)
        {
            self::single($v);
        }
    }
}