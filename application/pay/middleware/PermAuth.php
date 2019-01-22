<?php
/**
 * Created by PhpStorm.
 * User: grayVTouch
 * Date: 2019/1/13
 * Time: 9:39
 *
 * 权限认证
 */

namespace app\pay\middleware;

use Closure;
use app\pay\model\Route;
use app\pay\util\Misc;
use app\pay\util\User;
use think\Response;

class PermAuth
{
    private $exclude = [

    ];

    public function handle($request , Closure $next)
    {
        // 权限检查
        if (($res = $this->auth($request)) instanceof Response) {
            return $res;
        }
        return $next($request);
    }

    // 权限检查
    private function auth($request)
    {
        $mvc = Misc::mvc();
        foreach ($this->exclude as $v)
        {
            $reg = Misc::genReg($v);
            if (preg_match($reg , $mvc->path)) {
                return ;
            }
        }
        $user = Misc::user();
        if ($user->is_root == 'y') {
            // 超级管理员，跳过权限认证
            return ;
        }
        // 检查路由表是否存在该路由，如果不存在，默认为已授权
        $mvc = Misc::mvc();
        $count = Route::where([
            ['module' , '=' , $mvc->module] ,
            ['controller' , '=' , $mvc->controller] ,
            ['action' , '=' , $mvc->action] ,
        ])->count();
        if ($count == 0) {
            // 路由表中不存在该路由，默认放行
            return ;
        }
        $count = Route::alias('ro')
            ->join('role_permission rp' , 'ro.id = rp.route_id')
            ->where([
                ['rp.role_id' , '=' , $user->role_id] ,
                ['ro.module' , '=' , $mvc->module] ,
                ['ro.controller' , '=' , $mvc->controller] ,
                ['ro.action' , '=' , $mvc->action] ,
            ])->count();
        if ($count > 0) {
            // 角色权限中搜索到对应路由，那么用户具备该权限！放行
            return ;
        }

        // 无权限访问
//        User::loginOut();
        if ($request->isPost()) {
            return Misc::response('002' , '禁止访问');
        }
        return redirect(Misc::genUrl($mvc->module , 'Permission' , 'denyView'));
    }
}