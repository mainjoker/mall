<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/16
 * Time: 15:07
 */

namespace app\api\validate;


class TestFormToken extends BaseValidate
{
    protected $rule=[
        'username'=>'require|token',
    ];
    protected $message=[
        'username.require'=>'username参数不能为空',
        'username.token'=>'token令牌无效'
    ];

}