<?php
/**
 * Created by PhpStorm.
 * User: grayVTouch
 * Date: 2019/1/10
 * Time: 14:12
 *
 * 用户认证
 */

namespace app\pay\middleware;

use Closure;
use think\facade\Session;

class UserAuth
{
    // 排除认证的 uri
    private $exclude = [
        'pay/Login/login'
    ];

    // 已登录用户禁止访问的页面，统一重定向
    private $disabled = [
        'pay/Login/loginView' ,
    ];

    public function handle($request , Closure $next)
    {
        $mvc = mvc();
        // 登录检查
        if (!$this->auth($request)) {
            if ($request->isPost()) {
                return c_response('002' , '用户尚未登录');
            }
            if ($mvc['path'] != 'pay/Login/loginView') {
                return redirect(sprintf('/%s/Login/loginView' , $mvc['module']));
            }
            return $next($request);
        }
        // 已经登录的用户访问禁止登录页面，统一跳转回首页
        if (in_array($mvc['path'] , $this->disabled)) {
            if ($request->isPost()) {
                return c_response('002' , '您已经登录，请勿重复登录');
            }
            return redirect(sprintf('/%s/Index/indexView' , $mvc['module']));
        }
        return $next($request);
    }

    private function auth($request)
    {
        $path = $request->path();
        if (in_array($path , $this->exclude)) {
            return true;
        }
        return !is_null(user());
    }
}