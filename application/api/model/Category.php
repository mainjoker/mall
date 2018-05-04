<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/27
 * Time: 16:00
 */

namespace app\api\model;


use think\Model;

class Category extends  Model
{
    protected $hidden=['delete_time','update_time','description'];
    public static function getAllCategory(){
       return self::with('topImg')->select();
    }
    public function topImg(){
        return $this->belongsTo('Image','topic_img_id','id');
    }
    //根据分类id 获取该分类下的所有商品
    public static function getProductsByCate($id){
        $res=self::with(['products','topImg'])->where('id','=',$id)->find();
        //var_dump($res);exit;
        return $res;
    }
    public function products(){
        return $this->hasMany('Product','category_id','id');
    }

}