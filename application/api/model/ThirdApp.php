<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/16
 * Time: 11:05
 */

namespace app\api\model;


use think\Model;

class ThirdApp extends Model
{
    //登录
    public function checkAppToken($name,$pwd){
       return  self::where('app_id','=',$name)->where('app_secret','=',$pwd)->find();
    }
}