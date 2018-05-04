<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/12
 * Time: 14:38
 */

namespace app\exception;


class ErrorCodeException extends BaseException
{
    public $code       =402;
    public $msg        ='未知错误';
    public $err_code =200;
}