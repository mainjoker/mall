<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/28
 * Time: 10:27
 */

namespace app\api\model;


use think\Model;

class ProductImage extends Model
{
    public function img(){
        return $this->belongsTo('Image','img_id','id');
    }
}