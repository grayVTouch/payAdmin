<?php
/**
 * Created by PhpStorm.
 * User: grayVTouch
 * Date: 2019/1/10
 * Time: 14:12
 */

namespace app\pay\Controller;

use Exception;
use app\common\lib\Category;
use think\Controller as BaseController;
use app\pay\util\Misc;
use think\facade\View;
use app\pay\middleware\UserAuth;
use app\pay\middleware\PermAuth;
use app\pay\model\Route;

class Controller extends BaseController
{
    protected $middleware = [
        UserAuth::class ,
        PermAuth::class
    ];

    // 排除的路由
    private $exclude = [
        '*Login*'
    ];

    public function __construct()
    {
        parent::__construct();

        // 这边做一些简单的事情 ...
    }

    // 渲染视图（渲染视图前做些什么）
    protected function fetch($template = '' , $vars = [] , $config = [])
    {
        // 公共视图变量
        $this->shareVar();
        // 获取当前位置（需要排除的请在$exclude中指明）
        $this->pos();
        return parent::fetch($template , $vars , $config);
    }

    // 增加公共变量
    private function shareVar()
    {
        $url = config('app.url');
        $mvc = Misc::mvc();
        $plugin_url = sprintf('%s/plugin' , $url);
        $res_url = sprintf('%s/static' , $url);
        $pub_url = sprintf('%s/static/%s/Public' , $url , $mvc->module);
        $act_url = sprintf('%s/static/%s/%s' , $url , $mvc->module , $mvc->controller);

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
            'user'      => Misc::user()
        ]);
    }

    // 当前位置（面包屑）
    private function pos()
    {
        $mvc = Misc::mvc();
        foreach ($this->exclude as $v)
        {
            $reg = Misc::genReg($v);
            if (preg_match($reg , $mvc->path)) {
                return ;
            }
        }
        // 记录用户浏览足迹
        self::saveHis();
        // 找到当前路由
        $route = Route::where([
            ['module' , '=' , $mvc->module] ,
            ['controller' , '=' , $mvc->controller] ,
            ['action' , '=' , $mvc->action]
        ])->find();
        if (is_null($route)) {
            throw new Exception('未找到当前路径对应路由：' . $mvc->path);
        }
        $routes = Misc::route()->toArray();
        $pos = Category::parents($route->id , $routes , [
            'id' => 'id' ,
            'pid' => 'p_id'
        ] , true , false);
        array_walk($pos , function(&$v){
            $his = session('history');
            $v['link'] = $his[$v['link']] ?? '';
        });
        $res = [
            'all' => $pos ,
            'top' => $pos[0] ,
            'sec' => $pos[1] ,
            'cur' => $pos[count($pos) - 1]
        ];
        View::share([
            'pos' => $res
        ]);
        // 保存到 session
        session('pos' , $res);
    }

    // 保存用户浏览足迹（用于正确获取到用户当前位置）
    private function saveHis()
    {
        $path = '/' . request()->path();
        $url  = request()->url();
        $history = session('history') ?? [];
        $history[$path] = $url;
        session('history' , $history);
    }
}
