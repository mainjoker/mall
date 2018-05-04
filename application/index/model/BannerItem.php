<?php 
namespace app\index\model;
use app\index\model\BaseModel;
class BannerItem extends BaseModel
{
	protected $hidden=['delete_time','update_time','banner_id','key_word','id','type'];
	//protected $table='banner_item';
	public function img()
	{
		return $this->belongsTo('Image','img_id','id');
	}
}


 ?>