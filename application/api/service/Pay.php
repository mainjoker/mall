<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/9
 * Time: 11:25
 */

namespace app\api\service;


use app\api\model\OrderProduct;
use app\exception\ParamsException;
use Think\Exception;
use app\api\model\Order as orderModle;
use app\api\service\Order as orderService;
use WxPay\WxPayApi;

class Pay
{
    private $orderID;
    private $orderNo;
    private $uid;
    private $orderInfo;
    public function __construct($id,$uid)
    {
        if (!$id){
            throw new Exception('订单编号不能为空');
        }
        $this->orderID=$id;
        $orderInfo=orderModle::getOrderById($id);
        $this->orderInfo=$orderInfo;
        $this->orderNo=$orderInfo->order_no;
        $this->uid=$uid;
    }

    public function pay(){
        //根据订单id 获取订单信息
        if ($this->beforePay()){
            //支付成功 并改变了订单状态
            //返回参数 可能值 0:商品缺货等原因导致订单不能支付;  1: 支付失败或者支付取消； 2:支付成功；
            return ['statusCode'=>2];
        }

    }
    protected function beforePay(){
        //支付不了 假装支付成功了
//        if($this->checkOrder()){
//            //支付之前先用统一下单接口生成prepay_id
//            require \think\facade\Env::get('EXTEND_PATH').'/WxPay/WxPay.Data.php';
//            //require \think\facade\Env::get('EXTEND_PATH').'/WxPay/WxPay.Config.php';
//            $payData=new \WxPayUnifiedOrder();
//            $payData->SetBody('支付测试');
//            $payData->SetOut_trade_no($this->orderNo);
//            $payData->SetTotal_fee(1);
//            $payData->SetTrade_type('JSAPI');
//            $openid=GetToken::getVarFromToken('openid');
//            $payData->SetOpenid($openid);//公众账号ID
//            \WxPay\WxPayApi::unifiedOrder($payData);
//        }else{
//            throw new ParamsException([
//                'msg'=>'订单未知错误',
//            ]);
//        }
        if($this->checkOrder()){
            //改变订单状态
            $model=orderModle::get($this->orderID);
            $model->status=2;
            if($model->save()){
                return true;

            }else{
                throw new ParamsException([
                    'msg'=>'订单状态更新失败',
                ]);
            }
        }

    }
    protected function checkOrder(){
        //验证库存等
        $order=new orderService();
        $uid=$this->uid;
        $oProducts=OrderProduct::getProductsByOrderId($this->orderID);
        if($order->checkOrder($uid,$oProducts)){
            return true;
        }else{
            return false;
        }
    }

}