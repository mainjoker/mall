<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/16
 * Time: 14:26
 */

namespace app\api\model;


use think\Model;

class Product extends Model
{
    //首页最近新品
    public static function getMostRecent($count){
        $res=self::limit($count)->order('update_time desc')->select();
        return $res;
    }
    public function  getMainImgUrlAttr($value){
        return 'http://127.0.0.1/images'.$value;
    }
    //单品
    public static function getProductById($id){

//        $with[]=['imgList'] = function ($query) {
//            $query->order(['order' => 'asc']);
//        };
//        $product = self::with(['imgs'=>function($query){
//            $query->with(['imgUrl'])->order('order','asc');
//        }])->with('properties')->find($id);

       // $product=self::with(['imgList','imgList.img'])->find($id);
//        $product=self::with(['imgList'=>function($query){
//            $query->order('order','asc');
//        }])->with('imgList.img')->find($id);

        $product = self::with(['imgList'=>function($query){
            $query->with(['img'])->order('order','asc');
        }])->with('properties')->find($id);
        return $product;
    }
    public function properties(){
        return $this->hasMany('ProductProperty','product_id','id');
    }
    //商品图片
    public function imgList(){
        return $this->hasMany('ProductImage','product_id','id');
    }

}