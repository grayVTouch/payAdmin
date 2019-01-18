<?php
/**
 * Created by PhpStorm.
 * User: grayVTouch
 * Date: 2019/1/10
 * Time: 14:12
 *
 * 登录认证
 */

namespace app\pay\middleware;

use app\pay\util\Misc;
use Closure;
use think\Response;

class UserAuth
{
    // 排除认证的 uri
    private $exclude = [
        'pay/Login/login' ,
    ];

    // 已登录用户禁止访问的页面，统一重定向
    private $disabled = [
        'pay/Login/loginView' ,
    ];

    public function handle($request , Closure $next)
    {
        // 登录检查：未登录处理
        if (($res = $this->auth($request)) instanceof Response) {
            return $res;
        }
        // 登录检查：以登录处理
        if (($res = $this->limit($request)) instanceof Response) {
            return $res;
        }
        return $next($request);
    }

    // 登录检查：未登录处理
    private function auth($request)
    {
        $mvc = Misc::mvc();
        foreach ($this->exclude as $v)
        {
            $reg = Misc::genReg($v);
            if (preg_match($reg , $mvc->path)) {
                // 排除的 url
                return ;
            }
        }
        if (is_null(Misc::user())) {
            if ($request->isPost()) {
                return Misc::response('002' , '用户尚未登录');
            }
            if ($mvc->path != 'pay/Login/loginView') {
                return redirect(sprintf('/%s/Login/loginView' , $mvc->module));
            }
        }
    }

    // 登录检查：已登陆处理
    private function limit($request)
    {
        if (is_null(Misc::user())) {
            // 用户未登录无需检查
            return ;
        }
        $mvc = Misc::mvc();
        foreach ($this->disabled as $v)
        {
            $reg = Misc::genReg($v);
            if (preg_match($reg , $mvc->path)) {
                if ($request->isPost()) {
                    return Misc::response('002' , '您已经登录，请勿重复登录');
                }
                // 已经登录的用户访问禁止页面，统一跳转回首页
                return redirect(sprintf('/%s/Role/listView' , $mvc->module));
            }
        }
    }
}