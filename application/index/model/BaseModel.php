<?php
namespace app\index\model;
use think\Model;
class BaseModel extends Model
{
	public function prefixImgUrl($value,$data)
	{
        if($data['from'] == 1){
            $value = config('img_path').$value;
        }
        return $value;
	}

}