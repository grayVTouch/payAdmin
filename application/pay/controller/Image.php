<?php
/**
 * Created by PhpStorm.
 * User: grayVTouch
 * Date: 2019/1/15
 * Time: 15:37
 */

namespace app\pay\controller;

use Validate;
use app\pay\util\Misc;
use app\common\util\Image as UImage;

class Image extends Controller
{
    // 单张：保存图片
    public function single()
    {
        $image  = $_FILES['image'] ?? [];
        $image = UImage::single($image);
        if ($image['status'] == 'error') {
            return Misc::response('002' , $image['msg']);
        }
        return Misc::response('000' , '' , $image['data']);
    }

    // 多张：保存图片
    public function multiple()
    {
        $image  = $_FILES['image'] ?? [];
        $image = UImage::multiple($image);
        if ($image['status'] == 'error') {
            return Misc::response('002' , $image['msg']);
        }
        return Misc::response('000' , '' , $image['data']);
    }
}