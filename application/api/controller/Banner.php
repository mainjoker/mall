<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/24
 * Time: 11:47
 */

namespace app\api\controller;


use app\api\validate\BannerValidate;

class Banner extends BaseController
{
    public function getBanner($id){
        (new BannerValidate())->goCheck();
        $res=\app\api\model\Banner::getBannerById($id);
        return json($res);exit;
    }
}