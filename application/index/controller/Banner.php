<?php 
namespace app\index\controller;
use app\index\validate\Banner as bannerValidate;
//use think\Db;
use app\exception\MissException;
use app\index\model\Banner as bannerModel;
use app\index\model\BannerItem;
use think\facade\Env;

class Banner
{
	/**
	 * [getBanner description]
	 * @Author   HKB
	 * @DateTime 2018-03-28T14:30:31+0800
	 * @param    [type]                   $id [BannerID]
	 * @return   [type]                       [Banner resource]
	 */
	public function getBanner($id)
	{
		//dump(config('img_path'));exit;
		//根据bannerId获取对应的Baner
		//验证bannerId是否合法
		(new bannerValidate())->gocheck();
		//关联查询
		$res=bannerModel::getBannerByID($id);
		if (!$res) {
			throw new MissException(__FUNCTION__);
		}
		return $res;
	}
}