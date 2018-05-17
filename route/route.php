<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::get('hello/:name', 'index/index/hello');
Route::get('banner/:id', 'index/banner/getBanner');
Route::get('test', 'index/index/test');


//token uses
Route::post('api/token/user', 'api/Token/getToken');
Route::get('api/token/test', 'api/Token/test');
Route::get('api/token/token', 'api/Token/checkToken');

//token app
Route::post('api/token/app', 'api/Token/getAppToken');

//订单接口
Route::post('api/order', 'api/Order/placeOrder');
//订单列表
Route::get('api/order/user', 'api/Order/getAllOrders');
Route::get('api/order/info', 'api/Order/getProductsInfo');
Route::get('api/order/products/:id', 'api/Order/getProductsInfo');
Route::get('api/order/:id', 'api/Order/getOrderInfoById');

//添加地址接口
Route::post('api/address', 'api/address/addAddress');
//获取用户地址列表接口
Route::post('api/address/user', 'api/address/getAddress');
//获取Banner接口
Route::get('api/banner/:id', 'api/banner/getBanner');


//获取所有的theme
Route::get('api/theme/all$', 'api/theme/getThemeAll');
//获取特定theme接口
Route::get('api/theme/:id', 'api/theme/getThemesById');


//category接口

//获取首页最近新品
Route::get('api/product/recent$','api/product/getMostRecent');

//获取所有分类
Route::get('api/category/all$','api/category/getAllCategory');
//获取特定分类下的商品
Route::get('api/category/:id','api/category/getProductsByCate');


//product接口
Route::get('api/product/:id','api/product/getProductById');


//pay接口
Route::post('api/pay/payOrder','api/pay/payOrder');


//test
Route::get('api/test/token','api/test/token');
Route::post('api/test/form','api/test/form');







//http://www.tp51.io/index.php?s=api/order/test
//Route::get('?s=api/order/test', 'api/order/test');

//http://127.0.0.1/tp51/public/index.php/api/order/test

http://127.0.0.1/tp51/public/index.php?s=api/order/test

//Route::get('?s=api/order/test', 'api/order/test');
//Route::get('?m=api&c=order&a=test', 'api/order/test');



return [

];
