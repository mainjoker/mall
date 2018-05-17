<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/17
 * Time: 11:57
 */

namespace app\api\controller;


use app\api\model\OrderProduct;
use app\api\model\Product;
use app\api\validate\OrderPlace;
use app\api\service\Order as orderService;
use app\api\model\Order as orderModel;
use app\api\validate\IdMustBeInt;
use App\Http\Requests\Request;

class Order extends BaseController
{
    protected $beforeActionList = [
//        'checkUserScope' => ['only' => 'placeOrder,getAllOrders,getOrderInfoById']
//        'checkUserScope'
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
        $model=new orderService();
        $status=$model->place($uid,$products);
        return json($status);
    }
    public function getOrderInfoById($id){
        (new IdMustBeInt())->goCheck();
        return json(orderModel::getOrderById($id));
    }
    //获取订单列表
    public function getAllOrders(){
        $uid=self::getVarFromToken('uid');
        $page = request()->get('page');
        return json(orderModel::getAllOrders($uid,$page));
    }
    //获取订单中商品的信息
    //$id 订单id
    public function getProductsInfo($id){
        (new IdMustBeInt())->goCheck();
        $res=OrderProduct::getProductsByOrderId($id);
        return json($res);
//         $tmp=[];
//         $len=count($res);
//         for ($i=0; $i < $len; $i++) {
//             $tmp[$i]=Product::getProductById($res[$i]['product_id']);
//             //过滤无用字段
//             $productArr[$i]['name']=$tmp[$i]['name'];
//             $productArr[$i]['counts']=$res[$i]['count'];
//             $productArr[$i]['id']=$res[$i]['id'];
//             $productArr[$i]['main_img_url']=$res[$i]['main_img_url'];
//
//
//         }
//         return json($productArr);
//        var_dump($res);

    }
    public function test($id)
    {
       echo 'test';exit;
       $a=new OrderProduct();
       $res=$a->getProductsByOrderId($id);
       return $res;
    }
}