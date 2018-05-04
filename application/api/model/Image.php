<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/24
 * Time: 15:27
 */

namespace app\api\model;


use think\facade\Env;
use think\Model;

class Image extends Model
{
    protected $hidden=['delete_time','update_time','from'];

    public function getUrlAttr($value){
//        $publicPath=Env::get('APP_ROOT').'static/images';
       $publicPath='http://127.0.0.1/images';
        return $publicPath.$value;
    }
}