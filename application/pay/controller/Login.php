<?php
/**
 * Created by PhpStorm.
 * User: grayVTouch
 * Date: 2019/1/10
 * Time: 14:57
 */

namespace app\pay\controller;

use Validate;
use Db;

use app\common\util\Hash;

use app\pay\model\User;

class Login extends Controller
{
    /**
     * @title 登录视图
     * @author cxl
     */
    public function loginView()
    {
        return view('login');
    }

    /**
     * @ttile 登录
     * @author cxl
     */
    public function login()
    {
        $data = request()->post();
        $validator = Validate::make([
            'name' => 'require' ,
            'password' => 'require' ,
        ] , [
            'name.require' => '用户名必须提供' ,
            'password.require' => '密码必须提供' ,
        ]);
        if (!$validator->batch()->check($data)) {
            return c_response('001' , '' , $validator->getError());
        }
        $user = User::where('phone' , $data['name'])->find();
        if (is_null($user)) {
            return c_response('002' , '用户名或密码错误');
        }
        if (!Hash::verify($data['password'] , $user->password)) {
            return c_response('002' , '用户名或密码错误');
        }
        // 保存用户信息
        session('user' , $user);
        if ($data['remember'] == 'y') {
            // 记住密码
            $duration = time() + config('time.time_for_user');
            setcookie(session_name() , session_id() , $duration , '/');
        }
        return c_response('000' , '登录成功');
    }

    /**
     * @title
     * @author cxl
     */
    public function add()
    {
        $data = [
            'phone' => '13375086826' ,
            'password' => Hash::generate('123456')
        ];
        $user = new User();
        $user->allowField([
            'phone' ,
            'password'
        ])->save($data);
        return c_response('000' , '添加用户成功');
    }
}