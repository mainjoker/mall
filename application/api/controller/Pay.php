<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/8
 * Time: 16:58
 */

namespace app\api\controller;


use app\api\validate\IdMustBeInt;
use app\api\service\Pay as payService;
use think\Exception;

class Pay extends BaseController
{
    protected $beforeActionList=[
        'checkUserScope'=> ['only'=>'payOrder']
    ];
    //订单支付
    public function payOrder($id){
        (new IdMustBeInt())->goCheck();
        //验证订单所属是否正确
        $uid=$this->getVarFromToken('uid');

        if($this->checkOrderOnwer($uid,$id)){

            $pay=new payService($id,$uid);

            $res=$pay->pay();
            return json($res);
        }
    }
    public function checkOrderOnwer($uid,$id){

        $orderInfo=\app\api\model\Order::getOrderById($id);
        if (!$orderInfo){
            throw new Exception('该订单不存在');
            return false;
        }
        if($orderInfo->user_id!=$uid){
            throw new Exception('这不是您的订单');
            return false;
        }
        return true;
    }
}