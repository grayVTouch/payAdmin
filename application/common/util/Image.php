<?php
/**
 * Created by PhpStorm.
 * User: grayVTouch
 * Date: 2018/11/1
 * Time: 11:00
 */

namespace app\common\util;

use app\common\lib\UploadImage;
use app\pay\util\Misc;

class Image
{
    private static $_instance = null;

    /**
     * @title 保存单张上传图片
     * @param $image 上传的图片对象 $_FILES
     */
    public static function single($image)
    {
        self::instance();
        if (UploadImage::emptyFile($image)) {
            return self::response('error' , '请提供上传图片');
        }
        if (UploadImage::isMultiple($image)) {
            return self::response('error' , '请采用单张图片上传的方式');
        }
        if (UploadImage::isImage()) {
            return self::response('error' , '请仅上传 gif/jpg/png 格式图片文件');
        }
        $is_save_origin = config('app.is_save_origin');
        $image = self::$_instance->save($image , $is_save_origin);
        $image['url'] = Misc::genNetUrl($image['path']);
        unset($image['path']);
        return self::response('success' , '' , $image);
    }

    /**
     * @title 保存多张上传图片
     * @param $image 上传的图片对象 $_FILES
     */
    public static function multiple($image)
    {
        self::instance();
        if (UploadImage::emptyFile($image)) {
            return self::response('error' , '请提供上传图片');
        }
        if (!UploadImage::isMultiple($image)) {
            return self::response('error' , '请采用多张图片上传的方式');
        }
        if (UploadImage::isImage()) {
            return self::response('error' , '请仅上传 gif/jpg/png 格式图片文件');
        }
        $images = self::$_instance->saveAll($image , true);
        foreach ($images['success'] as &$v)
        {
            $v['url'] = Misc::genNetUrl($v['path']);
//            unset($v['path']);
        }
        return self::response('success' , '' , $images);
    }

    // 对象实例
    private static function instance(){
        if (is_null(self::$_instance)) {
            $dir = config('app.image_dir');
            self::$_instance = new UploadImage($dir);
        }
    }

    // 返回的信息
    private static function response($status , $msg = '' , $data = null){
        return compact('status' , 'msg' , 'data');
    }

}