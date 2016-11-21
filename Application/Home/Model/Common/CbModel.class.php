<?php
//自定义Modle父类
namespace Home\Model\Common;;
use Think\Model;

class CbModel {
	public $model_db;
    //父类的构造函数
    public function __construct(){
        //初始化model
        $Model = new Model();
        $this->model_db=$Model;
    }

}