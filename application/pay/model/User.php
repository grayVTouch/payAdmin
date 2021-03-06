<?php
/**
 * Created by PhpStorm.
 * User: grayVTouch
 * Date: 2019/1/11
 * Time: 10:28
 */

namespace app\pay\model;

use app\pay\util\Misc;
use think\Model as BaseModel;
use think\Model\Collection;

class User extends BaseModel implements Model
{
    // 角色
    public function role()
    {
        // 一对一
        return $this->belongsTo(Role::class , 'role_id' , 'id');
    }

    // 单条：数据处理
    public static function single(BaseModel $m = null)
    {
        if (is_null($m)) {
            return ;
        }
        $m->is_root_explain = Misc::mapVal('business.bool' , $m->is_root);
        $m->avatar_explain = Misc::avatar($m->avatar);
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