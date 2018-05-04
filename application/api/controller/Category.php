<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/27
 * Time: 15:57
 */

namespace app\api\controller;
use app\api\model\Category as categoryModel;
use app\api\validate\IdMustBeInt;

class Category extends BaseController
{
    //获取所有分类
    public function getAllCategory(){
        $res=categoryModel::getAllCategory();
        return json($res);
    }
    //获取某个分类下的所有商品
    public function getProductsByCate($id){
        (new IdMustBeInt())->goCheck();
        $res=categoryModel::getProductsByCate($id);
        return json($res);
    }

}