<?php
	namespace app\index\validate;
	use app\index\validate\BaseValidate;
	class User extends BaseValidate
	{
		protected $rule=[
			//'id'=>'require|IdMustInt',
			'name'=>'require|IdMustInt',
			//'email'=>'email',
		];
		protected $message=[
			// 'id.IdMustInt'=>'id必须是正整数',
			 'name.IdMustInt'=>'name必须是正整数',
			// 'id.require'=>'缺少id参数',
			// 'email.email'=>'email格式不正确'
		];
	}

 ?>