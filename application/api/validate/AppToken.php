<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/16
 * Time: 11:02
 */

namespace app\api\validate;


class AppToken extends BaseValidate
{
    protected $rule = [
        'name' => 'require|notEmpty',
        'pwd' => 'require|notEmpty',
    ];

    protected $message=[
        'name' => '账号不能为空',
        'pwd' => '密码不能为空',
    ];
}