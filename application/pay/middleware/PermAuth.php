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
        if (Misc::user()->is_root == 'y') {
            // 超级管理员，跳过权限认证
            return true;
        }
        $mvc = Misc::mvc();
        $perm = session('perm');
        if (is_null($perm)) {
            $perm = Route::alias('ro')
                ->join('role_permission rp' , 'ro.id = rp.route_id')
                ->where('rp.role_id' , user()->role_id)
                ->select();
            session('perm' , $perm);
        }
        // 检查用户是否拥有该权限
        foreach ($perm as $v)
        {
            if ($v->module == $mvc->module && $v->controller == $mvc->controller && $v->action == $mvc->action) {
                return ;
            }
        }
        if ($request->isPost()) {
            return Misc::response('002' , '禁止访问');
        }
        return redirect(Misc::genUrl($mvc->module , 'Permission' , 'deny'));
    }
}