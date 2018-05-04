<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/11
 * Time: 14:52
 */

namespace app\api\controller;


use app\exception\AccessException;
use app\exception\ParamsException;
use app\exception\TokenException;
use app\role\Role;
use think\Controller;
use think\facade\Cache;
use think\facade\Cookie;

class BaseController extends Controller
{
    //验证User权限
    public function checkUserScope()
    {
        //获取当前权限
        $scope = self::getVarFromToken('scope');
        $userScope=Role::USER;
        if ($scope){
            if ($scope==$userScope){
                return true;
            }else{
                throw new AccessException();
            }

        }else{
            throw new TokenException();
        }
        return true;

    }

    //验证Admin权限
    public function checkAdminScope()
    {
        //获取当前权限
        $scope = self::getVarFromToken('scope');
        $adminScope=Role::ADMIN;
        if ($scope){
            if ($scope==$adminScope){
                return true;
            }else{
                throw new AccessException();
            }

        }else{
            throw new TokenException();
        }
        return true;

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