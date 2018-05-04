<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/28
 * Time: 14:46
 */

namespace app\api\model;


use Think\Model;

class ThemeProduct extends Model
{
    public function productInfo(){
        return $this->belongsTo('Product','product_id','id');
    }
}