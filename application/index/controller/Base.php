<?php
namespace app\index\controller;
use think\Controller;
use think\Cookie;
use think\config;
class Base extends Controller
{
    protected $beforeActionList=[
        'beforeTesss'=>['only'=>'tesss'],
    ];

	public function tesss()
	{
		echo 'test123';
	}
	public function beforeTesss(){
	    echo 'before123';
    }
}



 ?>