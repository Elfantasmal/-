<?php
/**
 * 自定义Modle类
 * User表
 * @author: 成邦 <577426936@qq.com>
 */   
namespace Home\Model\Common;
use Think\Model;

class UserModel extends CbModel{
	public $table;
	//继承构造函数	
	public function __construct(){
		parent::__construct();
		//数据库表名
		$this->table='user';
	} 

	/**
     * 获取用户资料
     * @author: 成邦 <577426936@qq.com>
     */    
    public function getInfo($user_id){
    	$sql="SELECT 
    	user_id,
        user_name
        FROM 
    	 $this->table
    	WHERE 
    	is_on = 1  and user_id = $user_id

    	LIMIT 1 
    	";
    	$data = $this->model_db->query($sql);
        if(!$data){
            $data=null;
        }
    	return $data[0];      
    }

    // public function getIp($user_id){
    //     $list = $this->model_db->table('user')->where(array('user_id'=>$user_id))->find();
    //     echo  $this->model_db->getLastSql();
    // 	return $list;   
    // }
}