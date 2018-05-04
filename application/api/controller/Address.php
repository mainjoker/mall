<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/18
 * Time: 16:29
 */

namespace app\api\controller;


use app\api\model\UserAddress;

class Address extends BaseController
{
    protected $beforeActionList=[
        'checkUserScope'=>['only'=>'addAddress'],
    ];
    //用户添加新地址
    public function addAddress(){
        $uid=Token::getVarFromToken('uid');
        $post=input('post.');
        $post['user_id']=$uid;
        $address=new UserAddress();
        $address->allowField(true)->save($post);
        return $address->id;
    }

}