<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/17
 * Time: 10:06
 */

namespace app\api\model;


use think\Model;

class UserAddress extends Model
{
    protected $autoWriteTimestamp=true;
    public static function getUserAddress($uid){
        $where=['user_id'=>$uid,'moren'=>1];
        return self::where($where)->find();
    }
    //添加用户默认地址之前 先将原来的默认地址改成不是默认的
    public  function beforeAdd($addressInfo,$uid){
        $where=['user_id'=>$uid,'moren'=>1];
        $moren=self::where($where)->find();
        if($moren){
            $moren->moren=0;
            $res=$moren->save();
            if($res){
                return true;
            }else{
                return false;
            }
        }
        return true;
    }
}

