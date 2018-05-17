<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/18
 * Time: 11:21
 */

namespace app\api\model;


use think\Model;

class OrderProduct extends Model
{
    protected $autoWriteTimestamp = true;
    //根据订单id获取订单的商品
    public static function getProductsByOrderId($id){
//        $res=self::where('order_id','=',$id)->field(['product_id','count'])->select()->toArray();
        $res=self::where('order_id','=',$id)->select()->toArray();
        return $res;
    }
}