<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/12
 * Time: 15:44
 */

namespace app\exception;


class ParamsException extends BaseException
{
    //全局参数错误
    
    public $code       =200;
    public $msg        ='非法参数';
    public $err_code =10000;

}