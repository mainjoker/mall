<?php

namespace app\exception;

use think\Exception;

class BaseException extends Exception
{
    public $code = 404;
    public $msg = '未知错误';
    public $err_code = 999;

    public function __construct($params=[])
    {
        if (!is_array($params)) {
            return ;
        }

        if (array_key_exists('msg', $params)) {
            $this->msg = $params['msg'];
        }
        if (array_key_exists('code', $params)) {
            $this->code = $params['code'];
        }
        if (array_key_exists('err_code', $params)) {
            $this->err_code = $params['err_code'];
        }
    }
}


?>