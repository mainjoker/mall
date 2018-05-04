<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/24
 * Time: 14:46
 */

namespace app\api\model;


use think\Model;

class BannerItem extends Model
{
    protected $hidden=['delete_time','update_time'];
    public  function img(){
        return $this->belongsTo('Image','img_id','id');
    }
}