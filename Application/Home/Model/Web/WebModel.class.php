<?php
//自定义Modle父类
namespace Home\Model\Web;;
use Think\Model;

class WebModel {
	public $model_db;
    //父类的构造函数
    public function __construct(){
        //初始化model
        $Model = new Model();
        $this->model_db=$Model;
    }

}