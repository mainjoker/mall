<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/17
 * Time: 14:39
 */

namespace app\exception;


class TokenException extends BaseException
{
    //全局token
    public $code       =200;
    public $msg        ='token已过期或不合法的token';
    public $err_code =10001;
}