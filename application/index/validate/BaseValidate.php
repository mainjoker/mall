<?php
namespace app\index\validate;
use think\Validate;
use app\exception\BaseException;
class BaseValidate extends validate
{
	public $code;
	public $msg;
	public $err_code;
	public function gocheck()
	{
		$params=request()->param();
		$res=$this->batch()->check($params);
		if (!$res) {
			$error=$this->getError();
			$e=new BaseException;
			$e->msg=$error;
			$e->err_code=$this->err_code;
			throw $e;
		}
		// $arr=['msg'=>$this->msg,'err_code'=>$this->err_code];
		// return json($arr,$this->code);
		return true;
	}
	public function IdMustInt()
		{
			$id=request()->param('id');
			if (is_numeric($id) && is_int($id+0) && ($id+0)>0) {
				return true;
			}
			//id参数错误
			$this->err_code=10002;
			return false;
		}

}



 ?>