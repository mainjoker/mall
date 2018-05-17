<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/11
 * Time: 14:51
 */

namespace app\api\controller;


use app\api\model\ThirdApp;
use app\api\service\GetToken;
use app\api\validate\AppToken;
use app\api\validate\UserToken;
use app\api\service\AppToken as appService;
use think\facade\Env;
use think\facade\Request;

class Token extends BaseController
{
    //userToken
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
    //appToken
    public function getAppToken($name='',$pwd=''){
        (new AppToken())->goCheck();
        $app=new appService();
        $token=$app->get($name,$pwd);
        return json(['token'=>$token]);
    }

    public function test()
    {
        $name=request()->get('name');
        $pwd=request()->get('password');
        $model=new ThirdApp();
        $token=$model->checkAppToken($name,$pwd);
        var_dump($token);
    }
}