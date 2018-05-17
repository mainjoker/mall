<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/16
 * Time: 10:46
 */

namespace app\api\service;


use app\api\model\ThirdApp;
use app\exception\TokenException;

class AppToken extends BaseToken
{
    public function get($name,$pwd){
        $app=new ThirdApp();
        $res=$app->checkAppToken($name,$pwd);
        if ($res){
            //登录成功 存入缓存
            $token=$this->saveToCache($res);
            return $token;
        }else{
            //登录失败
            throw new TokenException([
                'msg'=>'授权失败'
            ]);
        }
    }
    private function saveToCache($res){
        $value=['uid'=>$res->id,'scope'=>$res->scope];
        $token=self::makeToken(32);
        $expire_in=config('wx.expire_in');
        $result=cache($token,$value,$expire_in);
        if(!$result){
            throw new TokenException([
                'msg' => '服务器缓存异常',
                'errorCode' => 10005
            ]);
        }
        return $token;
    }

}