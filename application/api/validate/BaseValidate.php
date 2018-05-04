<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/11
 * Time: 15:11
 */

namespace app\api\validate;


use app\exception\BaseException;
use app\exception\ParamsException;
use think\Validate;

class BaseValidate extends Validate
{
    public $code;//返回的状态码
    public $msg;//返回的提示信息
    public $errCode;//错误码

    public function goCheck()
    {
        $params = request()->param();
        $res = $this->batch()->check($params);
        if (!$res) {
            $error = $this->getError();
            $e = new ParamsException(
                [
                    //'msg' => $error,
                    //错误信息有可能是以数组的形式返回 故加以判断
                   'msg' => is_array($error) ? implode(
                        ';', $error) : $error,
                ]
            );
            throw $e;
        }
        return true;

    }

    //验证id是否为正整数  可用于验证接受的id参数
    //自定义验证函数有五个参数 分别为 验证数据（$value） 验证规则($rule) 全部数据，数组($array) 字段名($field) 字段描述($desc)
    public function idMustBeInt($value, $rule, $array, $field, $desc)
    {

        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        }
        return false;
       // return $field . '必须是正整数';
    }

    //验证参数是否为空
    public function notEmpty($value, $rule, $array, $field, $desc)
    {
        if (empty($value)) {
            //return $field . '不允许为空';
            return false;
        } else {
            return true;
        }
    }


}