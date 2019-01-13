<?php
/**
 * Created by PhpStorm.
 * User: grayVTouch
 * Date: 2019/1/13
 * Time: 10:22
 *
 * 以 Misc 作为命名空间的函数（可以这么理解）
 * 类本身并没有任何意义！
 */

namespace app\pay\util;

use app\pay\model\Route;

class Misc
{
    // 获取菜单
    public static function menu()
    {
        $menu = session('menu');
        if (is_null($menu)) {
            $menu = Route::menu(self::user()->role_id);
            session('menu' , $menu);
        }
        return $menu;
    }

    // 响应
    public static function response($code = 1 , $msg = '' , $data = [])
    {
        return self::json(compact('code' , 'msg' , 'data'));
    }

    // json 输出
    public static function json($data = [])
    {
        return json($data)->header(config('app.header'));
    }

    public static function mvc()
    {
        return new class() {
            public $path = '';
            public $module = '';
            public $controller = '';
            public $action = '';

            public function __construct()
            {
                $path = request()->path();
                $info = explode('/' , $path);
                $this->path = $path;
                $module = config('app.module');
                if (empty($module)) {
                    // 无默认模块
                    $this->module = $info[0];
                    $this->controller = $info[1];
                    $this->action = $info[2];
                } else {
                    // 有默认模块
                    $this->module = $module;
                    $this->controller = $info[0];
                    $this->action = $info[1];
                }
            }
        };
    }

    // 生成 url
    public static function genUrl($m , $c , $a , $param = [])
    {
        $module = config('app.module');
        $query_str = http_build_query($param);
        $query_str = empty($query_str) ? '' : '?' . $query_str;
        $url = empty($module) ? sprintf('/%s/%s/%s' , $m , $c , $a) : sprintf('/%s/%s' , $c , $a);
        $url .= $query_str;
        return $url;
    }

    // 获取用户数据
    public static function user()
    {
        return session('user');
    }

    // 获取所有路由
    public static function route()
    {
        $route = session('route');
        if (is_null($route)) {
            $route = Route::_all();
            session('route' , $route);
        }
        return $route;
    }

    // 生成正则字符串
    // 根据 *
    // 目前仅支持 *，其他符号，请勿用！！
    public static function genReg($str = '')
    {
        $str = str_replace('*' , '.*' , $str);
        $str = str_replace('/' , '\/' , $str);
        return sprintf('/%s/i' , $str);
    }

}