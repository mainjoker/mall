<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/17
 * Time: 15:31
 */

namespace app\api\validate;


use app\exception\ParamsException;

class OrderPlace extends BaseValidate
{
    protected $rule = [
        'products' => 'checkProducts'

    ];
    protected $singleRule = [
        'product_id' => 'require|idMustBeInt',
        'count' => 'require|idMustBeInt'
    ];
    protected $message=[
        'product_id'=>'product_id应为正整数',
        'count'=>'商品数量应为正整数',
    ];

    public function checkProducts($value)
    {
        if (!$value) {
            throw new ParamsException([
                'msg' => '商品为空，不能下单',
            ]);
        }
        if (!is_array($value)) {
            throw new ParamsException([
                'msg' => '非法参数'
            ]);
        }
        foreach ($value as $v) {
            $this->checkProduct($v, $this->singleRule);
        }
        return true;

    }

    public function checkProduct($data, $rule)
    {
        $res = $this->check($data, $rule);
        if (!$res) {
            $msg=$this->getError();
            throw new ParamsException([
                'msg' => $msg,
            ]);
        }
    }
}