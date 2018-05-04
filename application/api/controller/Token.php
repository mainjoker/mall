<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/11
 * Time: 14:51
 */

namespace app\api\controller;


use app\api\model\Product;
use app\api\model\User;
use app\api\model\UserAddress;
use app\api\service\GetToken;
use app\api\validate\UserToken;
use extend\WxPay\WxPayApi;
use think\Cache;
use think\facade\Request;

class Token extends BaseController
{
    public function getToken($code = '')
    {
        //判断code是否存在
        (new UserToken())->goCheck();
        //如果存在 则获取token
        $ut = new GetToken($code);
        $token = $ut->get($code);
        if ($token) {
            return json(['token' => $token]);
        }
    }

    //验证token是否过期 token存在的情况下
    public function checkToken(){
        $token=Request::get('token');
        $cache=Cache($token);
        $res['status']=false;
        if($cache){
            $res['status']=true;
        }
        return json($res);
    }

    public function test()
    {
        $token=\think\facade\Cache::get('e696a81cccb624fa1c7e82a3f94655bb');
        $token1=Cache('e696a81cccb624fa1c7e82a3f94655bb');
        var_dump($token);
        var_dump($token1);
    }
}