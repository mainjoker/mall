<?php 
namespace app\index\model;
use app\index\model\BaseModel;

class Banner extends BaseModel
{
	protected $table='banner';
	protected $hidden=['delete_time','update_time'];
	public function items()
    {
        return $this->hasMany('BannerItem', 'banner_id', 'id');
    }
    public static function getBannerByID($id)
    {
    	return $res=self::with(['items','items.img'])->find($id);
    }
}
