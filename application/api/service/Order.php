<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/17
 * Time: 15:55
 */

namespace app\api\service;



use app\api\model\Product;
use app\exception\ParamsException;
use think\Db;
use think\Exception;
use app\api\model\Order as orderModel;
use app\api\model\OrderProduct;

class Order
{
    //从客户端传递过来的products数据
    protected $oProducts;
    //根据客户端传递过来的商品数据查询出来的数据库的真实数据
    protected $products;
    protected $uid;
    //单个商品的信息(从数据库取出)
    protected $pInfo=[];
    //生成订单
    public function place($uid,$oProducts){
        //初始化数据
        $this->oProducts=$oProducts;
        $this->uid=$uid;
        //检查订单状态
        $status=$this->getOrderStatus();
        $this->products=$this->getProducts();
        if ($status){
            //验证通过 正式生成订单
            return $this->placeOrder();
        }else{
            throw new ParamsException([
                'msg'=>'下单失败，未知错误！',
            ]);
        }
    }
    //正式生成订单
    private function placeOrder(){
        $data=$this->preOrder();
        $order=new orderModel();
        $orderProduct=new OrderProduct();
        try{
            Db::startTrans();
            $order->allowField(true)->save($data);
            $order_id=$order->id;
            $data1=$this->oProducts;
            for($i=0;$i<count($this->oProducts);$i++){
                $data1[$i]['order_id']=$order_id;
            }
            $orderProduct->saveAll($data1);
            Db::commit();
            return [
                'order_no' => $data['order_no'],
                'order_id' => $order_id,
            ];
        }catch (Exception $e){
            throw $e;
        }


    }
    //生成订单预处理
    private function preOrder(){
        //获取订单总价orderPrice
        $order_total_price=0;
        $data=[];
        foreach($this->pInfo as $v){
            $order_total_price+=$v['totalPrice'];
        }
        //获取订单编号
        $data['order_no']=$this->makeOrderNo();
        //订单中有几种商品
        $data['total_count']=count($this->oProducts);
        $data['total_price']=$order_total_price;
        $data['user_id']=$this->uid;
        $data['snap_img']=$this->products[0]['main_img_url'];//封面图片
        $data['snap_name']=$this->products[0]['name'];//封面名称
        if (count($this->oProducts)>1){
            $data['snap_name'].='等';
        }
        //地址信息 还没做 先填默认
        $data['snap_address']='福建省厦门市软件园三期';//封面名称
        return $data;
    }
    private function getOrderStatus(){
        //验证订单状态即验证订单中的商品是否合法 是否有足够的库存等 是否存在对应的商品等
        $pindex=1;
        for ($i=0;$i<count($this->oProducts);$i++){
            if(!$this->getProductStatus($i,$this->oProducts[$i]['product_id'],$this->oProducts[$i]['count'])){
                $pindex=-1;
            }
        }
        if($pindex==-1){
            return false;
        }
        return true;

    }
    //根据客户端的数据查出数据库中商品的相关数据
    private function getProducts(){
        $oProducts=$this->oProducts;
        $pid=[];
        foreach ($oProducts as $v){
            $pid[]=$v['product_id'];
        }
        $products=Product::all($pid)->toarray();
        return $products;
    }
    //检查商品中每个商品的状态（库存是否足够）
    //检查订单中每个商品的状态
    //$i循环进来时候的索引值  $pid 商品id $oCount订单中的商品数量
    //检查库存是否足够
    private function getProductStatus($i,$pid,$oCount){
        $productModel=new Product();
        $proInfo=$productModel->find($pid);
        if (!$proInfo){
            throw new ParamsException([
                'msg'=>'id为'.$pid.'的商品不存在',
            ]);
        }
        $proInfo=json_decode($proInfo,true);
        $stock=$proInfo['stock'];
        if ($stock<$oCount){
            throw new ParamsException([
                'msg'=>'商品id为'.$pid.'的商品库存不足',
            ]);
        }else{
            $this->pInfo[$i]['name']=$proInfo['name'];
            $this->pInfo[$i]['id']=$proInfo['id'];
            $this->pInfo[$i]['main_img_url']=$proInfo['main_img_url'];
            $this->pInfo[$i]['totalPrice']=$oCount*$proInfo['price'];
            $this->pInfo[$i]['count']=$oCount;
        }
        return true;
    }

    //生成订单编号
    public static function makeOrderNo()
    {
        $yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
        $orderSn =
            $yCode[intval(date('Y')) - 2017] . strtoupper(dechex(date('m'))) . date(
                'd') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf(
                '%02d', rand(0, 99));
        return $orderSn;
    }
}