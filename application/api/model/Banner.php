<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/24
 * Time: 14:42
 */

namespace app\api\model;


use think\Model;

class Banner extends Model
{
    protected $hidden=['delete_time','update_time'];
    public static function  getBannerById($id){
        return self::with(['items','items.img'])->find($id);
    }
    public function items(){
        return $this->hasMany('BannerItem','banner_id','id');
    }

}