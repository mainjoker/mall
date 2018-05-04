<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/27
 * Time: 15:24
 */

namespace app\api\controller;


use app\api\model\Product as productModel;
use app\api\validate\IdMustBeInt;
class Product extends BaseController
{
    //首页最近新品
    public function getMostRecent($count=15){
        $res=productModel::getMostRecent($count);
        return json($res);
    }
    //获取某个单品信息
    public function getProductById($id){
        (new IdMustBeInt())->goCheck();
        $res=productModel::getProductById($id);
        return json($res);
    }

}