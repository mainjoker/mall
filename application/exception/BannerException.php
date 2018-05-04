<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/24
 * Time: 14:16
 */

namespace app\exception;


class BannerException extends BaseException
{
    public $code       =404;
    public $msg        ='该Banner不存在';
    public $err_code =100;
}