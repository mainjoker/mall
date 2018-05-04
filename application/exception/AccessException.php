<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/17
 * Time: 15:19
 */

namespace app\exception;


class AccessException extends BaseException
{
    //权限错误
    public $code       =403;
    public $msg        ='您不具有该权限';
    public $err_code =10002;
}