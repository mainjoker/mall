<?php

namespace app\index\controller;

use app\index\model\Token;
use think\Exception;
use app\index\validate\User as paramsValidate;
use think\Controller;
use think\Db;
use think\facade\Env;
use app\index\model\Banner;
use app\index\controller\Base;
use think\facade\Request;
use think\facade\Response;

class Index extends Base
{
    protected $failException = true;
    protected $resultSetType = 'collection';


//    public function initialize()
//    {
//        //echo 123;
//    }

    public function index()
    {
        $task = 'good';

        $test = 'test';

        $stop = 'stop';


        //return json($task);
    }

    public function hello()
    {
        $start = 'yeah';
        (new paramsValidate())->gocheck();
        $msg = 'ok';
        return json($msg);

    }

    /**
     *
     */
    public function test()
    {
       return $this->tesss();

    }

    private function testfuc()
    {

    }
}
