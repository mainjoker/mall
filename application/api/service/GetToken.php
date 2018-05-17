<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/11
 * Time: 15:41
 */

namespace app\api\service;

use app\api\model\User as UserModel;
use app\api\model\User;
use app\role\Role;
use app\exception\CacheException;
use app\exception\ErrorCodeException;
use think\facade\Cache;
use think\facade\Cookie;


class GetToken extends BaseToken
{
    private $appId;
    private $appSecret;
    private $tokenUrl;
    private $code;

    public function __construct($code)
    {
        $this->appId = config('wx.appId');
        $this->appSecret = config('wx.appSecret');
        $tokenUrl = config('wx.tokenUrl');
        $this->code = $code;
        $this->tokenUrl = sprintf($tokenUrl, $this->appId, $this->appSecret, $this->code);
    }


    public function get()
    {
        //根据code去拿openid和session_key等信息
        //验证code是否合法？是否过期等
        if ($res = $this->checkCode()) {
            //拿到合法的openid 查看是否存在该用户
            $openid = $res['openid'];
            $user = User::getByOpenId($openid);
            if (!$user) {
                $uid = $this->newUser($openid);
            } else {
                $uid = $user->id;
            }
            return $this->grantToken($res, $uid);
        }

    }


    //添加新用户
    private function newUser($openid)
    {
        $user = User::create(
            [
                'openid' => $openid
            ]);
        return $user->id;
    }

    //组装token并存入缓存
    public function grantToken($res, $uid)
    {
        $token = $this->makeToken(32);
        $value = $res;
        $value['uid'] = $uid;
        //权限
        $value['scope'] = Role::USER;
        $expire_in = config('wx.expire_in');
        $value['expire_in'] = $expire_in;
        $cache = cache($token, json_encode($value), $expire_in);
        if (!$cache) {
            throw new CacheException([
                'msg' => '缓存错误',
            ]);
        }
        //返回token 根据token去拿value的值
        return $token;
    }

    //验证code
    public function checkCode()
    {

        //公共函数
        $res = json_decode(httpGet($this->tokenUrl), true);//转化成数组
        if (array_key_exists('errcode', $res)) {
            //code过期等问题 code不合法等问题
            //var_Dump($res);
            throw new ErrorCodeException(
                [
                    'msg' => $res['errmsg'],
                    'err_code' => $res['errcode'],
                ]
            );
        } elseif (empty($res)) {
            throw new ErrorCodeException(
                [
                    'msg' => '获取openid失败，微信内部错误',
                ]
            );
        }
        return $res;

    }
}