<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/17
 * Time: 11:57
 */

namespace app\api\controller;


use app\api\model\Product;
use app\api\service\GetToken;
use app\api\validate\OrderPlace;
use think\facade\Cache;
use app\api\service\Order as orderModel;
use think\facade\Log;

class Order extends BaseController
{
    protected $beforeActionList = [
        'checkUserScope' => ['only' => 'placeOrder']
    ];
    //下单接口
    //下单之前应该先验证权限beforeActionList
    public function placeOrder()
    {
        //验证参数
        (new OrderPlace())->goCheck();
        $products = input('post.products/a');
        $uid=self::getVarFromToken('uid');
        //下单结果
        $model=new orderModel();
        $status=$model->place($uid,$products);
        return json($status);
    }
    public function test()
    {
        var_dump('test');
//        $res=Log::record('This is a test');
//        if ($res){
//            echo 'ok';
//            var_dump($res);
//        }else{
//            echo 'not ok';
//        }

    }
}