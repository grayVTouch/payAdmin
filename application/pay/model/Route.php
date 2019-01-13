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

use think\Model;
use think\Model\Collection;

class Route extends Model
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

    // 所有记录
    public static function _all()
    {
        return self::select()->each(function($v){
            $v->link = self::url($v->module , $v->controller , $v->action);
        });
    }

    // 生成链接
    private static function url($m , $c , $a)
    {
        return $m == '' || $c == '' || $a == 'javascript:void;' ? '' : Misc::genUrl($m , $c , $a);
    }
}