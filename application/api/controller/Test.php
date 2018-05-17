<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/16
 * Time: 14:50
 */

namespace app\api\controller;


use app\api\validate\TestFormToken;
use think\Controller;

class Test extends Controller
{
    public function token(){
//        $token = call_user_func('md5', $_SERVER['REQUEST_TIME_FLOAT']);
//        var_dump($token);

        $token = $this->request->token('__token__', 'sha1');
        return $this->fetch('token');
    }
    public function form(){
        (new TestFormToken())->goCheck();
        var_dump($_POST);
    }
}