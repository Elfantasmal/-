<?php
/**
 * 自定义Modle类
 * User表
 * @author: 成邦 <577426936@qq.com>
 */   
namespace Home\Model\Web;
use Think\Model;

class UserModel extends WebModel{
	public $table;
	//继承构造函数	
	public function __construct(){
		parent::__construct();
		//数据库表名
		$this->table='user';
	} 

	/**
     * 添加用户
     * @author 廖成邦
     */
    public function add($data){
        $info=$this->model_db->table($this->table)->add($data);
        if(!$info){
            throw new ModelErrorException('添加数据失败','ADD_CAPITAL_LOG_FAIL');
        }
        return $info;
    }

    /**
     * 更新用户
     * @author 廖成邦
     */
    public function edit($data){
        $info=$this->model_db->table($this->table)->save($data);
        if(!$info){
            throw new ModelErrorException('添加数据失败','ADD_CAPITAL_LOG_FAIL');
        }
        return $info;
    }

    /**
     * 修改(sql语句)
     * @author jieyang
     */
    public function reduceMoney($money,$uid){
        $sql="UPDATE $this->table SET balance = balance - ?,total_getcash = total_getcash + ? WHERE uid = ?";
        $info=$this->model_db->query($sql);
        if(!$info){
            return false;
        }
        return true;
    }
}