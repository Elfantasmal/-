<?php
namespace Home\Controller;
use Think\Controller;

class LoginController extends TpController {

    public function index(){
	    //加载模型
	    // $model = D('user');
	    $model = new \Home\Model\Common\UserModel();        
        //查询用户资料
        $user_id=1;
        $list = $model->getInfo($user_id);
        //加载辅助函数
        // load('Common.myfunction');
        // $list =getOrderNumber();
        //$list=date('Y-m-d'.'00:00:00',time());
        //加载模型
        $data=array(
            'user_account'=>"jxj",
            'user_name'=>"季小杰"
        );
        $model = new \Home\Model\Web\UserModel();        
       // $id=$model->add($data);
        //$this->ajaxReturn($id);
        //$this->display();
        //$this->success();
	} 

    public function login(){
        // $data=I('get.');
        // $rule=array(
        //     'user_account'=>array(null,null,true),
        //     'user_name'=>array(null,null,true),
        //     'id'=>array('egNum',null,true),
        // );
        // $this->verify($rule,$data);
        // foreach($rule as $k=>$v){
        //     isset($data[$k])?$save[$k]=$data[$k]:'';
        // }
        // var_dump($save);die();
        //$trade_no=time().rand(100000,999999);
    
        //加载模型
        // $model = D('user');
        // $model = new \Home\Model\Common\UserModel();        
        //查询用户资料
        //$user_id=2;
        //$list = $model->getInfo($user_id);
        //加载辅助函数
        // load('Common.myfunction');
        // $list =getOrderNumber();
        $list = strtotime(date('Y-m-d'.'00:00:00',time()))+23*60*60+40*60;
        $this->ajaxReturn($list);
        //$this->display();
    } 

    public function add_culture(){
        //开始事物
        $model->startTrans();
        try{



        }catch(ModelErrorException $e){
            //回滚事务
            $model->rollback();
            throw new RJsonErrorException($e->getMessage(),$e->getErrorId(),$e->getCode());
           // return false;
        }
            //提交事务
            $model->commit();
    }    
}
?>