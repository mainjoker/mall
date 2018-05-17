<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/18
 * Time: 15:15
 */

namespace app\api\model;


use think\Model;

class Order extends Model
{
    protected $autoWriteTimestamp = true;
    //根据订单id 获取订单信息
    public static function getOrderById($id){
        return self::get($id);
    }
    //获取订单列表
    public static function getAllOrders($uid,$page){
        $pageRows=5;//分页数据
        $offset=$pageRows*($page-1);
    	return self::where('user_id','=',$uid)->limit($offset,$pageRows)->order('update_time DESC')->select();
    }

}