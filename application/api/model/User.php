<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/12
 * Time: 11:53
 */

namespace app\api\model;

use think\Model;


class User extends Model
{
    // protected $table='pro_users';
    public static function getByOpenId($openid)
    {
        $user = User::where("openid", '=', $openid)->find();
        return $user;
    }
}