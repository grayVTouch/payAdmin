<?php
/**
 * Created by PhpStorm.
 * User: grayVTouch
 * Date: 2019/1/15
 * Time: 15:03
 */

// 系统根目录
function base_path(){
    return format_path(str_replace('\\' , '/' , realpath(__DIR__ . '/../../'))) . '/';
}

// 资源目录
function public_path(){
    return base_path() . 'public/';
}