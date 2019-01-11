<?php
/**
 * Created by PhpStorm.
 * User: grayVTouch
 * Date: 2019/1/10
 * Time: 14:12
 */

namespace app\pay\Controller;

use think\Controller as BaseController;

use think\facade\View;
use app\pay\middleware\UserAuth;

class Controller extends BaseController
{
    protected $middleware = [
        UserAuth::class ,
    ];

    public function __construct()
    {
        parent::__construct();

        // 这边做一些简单的事情 ...

        // 公共视图变量
        $this->shareVars();
    }

    // 增加公共变量
    private function shareVars()
    {
        $url = config('app.url');
        $mvc = mvc();
        $plugin_url = sprintf('%s/plugin' , $url);
        $res_url = sprintf('%s/static' , $url);
        $pub_url = sprintf('%s/static/%s/Public' , $url , $mvc['module']);
        $act_url = sprintf('%s/static/%s/%s' , $url , $mvc['module'] , $mvc['controller']);

        // 视图共享变量
        View::share([
            // host
            'url'       => config('app.url') ,
            // 应用版本（用于控制缓存更新）
            'version'   => config('app.version') ,
            // 插件路径
            'plugin_url' => $plugin_url ,
            // 资源路径
            'res_url'   => $res_url ,
            // 公共视图 url
            'pub_url'   => $pub_url ,
            // 当前方法视图 url
            'act_url'   => $act_url ,
            // 当前登录用户信息
            'user'      => user()
        ]);
    }
}