<?php
/**
 * Created by PhpStorm.
 * User: grayVTouch
 * Date: 2019/1/17
 * Time: 17:28
 */

namespace app\pay\model;

use think\Model as BaseModel;
use think\Model\Collection;

class _Empty extends BaseModel implements Model
{
    // 单条：数据处理
    public static function single(BaseModel $m = null)
    {
        if (is_null($m)) {
            return ;
        }
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