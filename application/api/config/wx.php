<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/11
 * Time: 17:14
 */

return [
    'salt'=>'hkbtest',
    'appId'=>'wx5450cee0ea87fc33',
    'appSecret'=>'e3a5510c7d5ead8d0a4e11bfed3b8af5',
    'tokenUrl'=>'https://api.weixin.qq.com/sns/jscode2session?appid=%s&secret=%s&js_code=%s&grant_type=authorization_code',
    'expire_in'=>7000,//token缓存过期时间
];