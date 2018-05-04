<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/12
 * Time: 14:37
 */

namespace app\exception;


class CacheException extends BaseException
{
    public $code       =403;
    public $msg        ='缓存错误';
    public $err_code =100;
}