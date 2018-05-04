<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/11
 * Time: 15:26
 */

namespace app\api\validate;


class UserToken extends BaseValidate
{

    protected $rule = [
        'code' => 'require|notEmpty'
    ];

    protected $message=[
        'code' => '确少code参数'
    ];
}