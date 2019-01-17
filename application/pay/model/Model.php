<?php
/**
 * Created by PhpStorm.
 * User: grayVTouch
 * Date: 2019/1/17
 * Time: 17:22
 */

namespace app\pay\model;

use think\Model as BaseModel;
use think\Model\Collection;

interface Model
{
    // 单条：数据处理
    public static function single(BaseModel $m = null);
    // 多条：数据处理
    public static function multiple(Collection $collection);
}