<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/16
 * Time: 10:43
 */

namespace app\api\service;


class BaseToken
{

    //获取签名字符串
    public function createNonceStr($length = 16)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    //生成基于当前时间的token
    public function makeToken($len){
        $nonceStr=$this->createNonceStr($len);
        $timestamp=$_SERVER['REQUEST_TIME_FLOAT'];
        $salt=config('wx.salt');
        return md5($nonceStr.$timestamp.$salt);
    }
    //根据token的值 获取对应的参数值（从缓存中）
    public static function getVarFromToken($var)
    {
        $token = request()->header('token');
        $cache = Cache::get($token);
        if (!$cache) {
            throw new TokenException();
        } else {
            $cache = json_decode($cache, true);
        }
        if (!array_key_exists($var, $cache)) {
            throw new ParamsException([
                'msg' => 'token中不存在该变量'
            ]);
        }
        return $cache[$var];

    }
}