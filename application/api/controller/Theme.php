<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/27
 * Time: 14:06
 */

namespace app\api\controller;
use app\api\model\Theme as themeModel;


use app\api\validate\ThemeValidate;

class Theme extends BaseController
{
    public function getThemesById($id){
        (new ThemeValidate())->goCheck();
        $res=themeModel::getThemesById($id);
        return json($res);

    }
    public function getThemeAll(){
        $res=themeModel::getThemesAll();
        return json($res);
    }

}