<?php 
namespace app\exception;
use app\exception\BasEexception;
use think\exception\Handle;
use think\Request;
use think\Config;
//use think\Exception;

class BaseExceptionHandler extends Handle
{
	public $code;
	public $msg;
	public $err_code;
	public function render(\Exception $e)
	{
		if ($e instanceof BaseException) {
			//如果是自定义的异常
			$this->code=$e->code;
			$this->msg=$e->msg;
			$this->err_code=$e->err_code;
		}else{
			if (config('app_debug')) {
				return parent::render($e);
			}else{
				$this->code=500;
				$this->msg='服务器内部异常';
				$this->err_code=999;
			}
		}

		$request=new Request;
		$url=$request->url();
		$res=[
			'msg'=>$this->msg,
			'err_code'=>$this->err_code,
			'url'=>$url
		];
		return json($res,$this->code);
	}

}



 ?>