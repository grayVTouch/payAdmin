<?php
/**
 * Created by PhpStorm.
 * User: grayVTouch
 * Date: 2019/1/10
 * Time: 14:12
 */

namespace app\pay\controller;


class Index extends Controller
{
    public function indexView()
    {
        return $this->fetch('index');
    }

    public function index()
    {
        echo 'hello world';
    }
}