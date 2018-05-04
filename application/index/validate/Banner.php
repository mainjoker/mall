<?php 
namespace app\index\validate;
use app\index\validate\BaseValidate;
class Banner extends BaseValidate
{
	protected $rule=[
		'id'=>'require|IDMustInt'
	];
	protected $message=[
		'id.require'=>'bannerId不能为空',
		'id.IDMustInt'=>'bannerId必须是正整数'
	];
}

 ?>