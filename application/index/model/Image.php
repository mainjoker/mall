<?php 
namespace app\index\model;
use app\index\model\BaseModel;
class Image extends BaseModel
{
	protected $hidden=['id','from','delete_time','update_time'];
	public function getUrlAttr($value,$data)
	{
		return $this->prefixImgUrl($value,$data);
	}

}

