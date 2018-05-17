<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/18
 * Time: 16:29
 */

namespace app\api\controller;


use app\api\model\User;
use app\api\model\UserAddress;
use app\exception\ParamsException;

class Address extends BaseController
{
    protected $beforeActionList=[
        'checkUserScope'=>['only'=>'addAddress,getAddress'],
        //'checkUserScope',
    ];
    //用户添加新地址
    public function addAddress(){
        $uid=Token::getVarFromToken('uid');
        $post=input('post.');
        $post['user_id']=$uid;
        $address=new UserAddress();
        if($address->beforeAdd($post,$uid)){
            $address->allowField(true)->save($post);
            return json(['id'=>$address->id]);
        }else{
            throw new ParamsException([
                'msg'=>'新增地址失败',
            ]);
        }
    }
    //获取用户默认地址
    public function getAddress(){
        $uid=Token::getVarFromToken('uid');
        $res=UserAddress::getUserAddress($uid);
        return json($res);
    }
    public function test(){

    }

}