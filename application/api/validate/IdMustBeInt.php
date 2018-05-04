<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/27
 * Time: 17:02
 */

namespace app\api\validate;


class IdMustBeInt extends BaseValidate
{
    protected $rule=[
        'id'=>'require|idMustBeInt',
    ];
    protected $message=[
        'id.require'=>'id参数不能为空',
        'id.idMustBeInt'=>'id必须是正整数'
    ];

}