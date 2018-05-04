<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/27
 * Time: 14:14
 */

namespace app\api\model;


use app\exception\ParamsException;
use think\Model;

class Theme extends Model
{
    protected $hidden=['delete_time','topic_img_id','head_img_id','update_time'];
    public static function getThemesById($id){
        $res=self::with(['topImg','headImg','productList'])->where('id','=',$id)->find($id);
        if(!$res){
            throw new ParamsException([
                'msg'=>'该主题不存在',
            ]);
        }
        return $res;
    }
    public static function getThemesAll(){
        $res=self::with(['topImg','headImg'])->select();
        return $res;
    }
    public function topImg(){
        return $this->belongsTo('Image','topic_img_id','id');
    }
    public function headImg(){
        return $this->belongsTo('Image','head_img_id','id');
    }
    //某主题下的商品
    public function productList(){
        return $this->belongsToMany(
            'Product', 'theme_product', 'product_id', 'theme_id');
        //return $this->hasMany('ThemeProduct','theme_id','id');
    }

}