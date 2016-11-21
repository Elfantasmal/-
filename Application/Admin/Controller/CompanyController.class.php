<?php
namespace Admin\Controller;
use Think\Controller;
class CompanyController extends Controller{
	/**
	 * µ¼³öEXCEL
	 * date:2016-10-31
	 * author:yuan
	 */
	public function expCompany(){//µ¼³öExcel
		$time = time();
        $xlsName  = "ÕþÆó»¥Í¨×¢²áÐÅÏ¢".$time;
        $xlsCell  = array(
            array('id','ÕËºÅÐòÁÐ'),
            array('company_name','ÆóÒµÃû³Æ'),
            array('contants','ÁªÏµÈË'),
            array('nickname','êÇ³Æ'),
            array('phone','ÁªÏµÈËÊÖ»ú'),
            array('email','µç×ÓÓÊÏä'),
            array('addtime','Ìí¼ÓÊ±¼ä')
        );
        $xlsModel = M('company');
        $xlsData  = $xlsModel->Field('id,company_name,contants,nickname,phone,email,addtime')->order('id asc')->select();
		//Ê±¼ä´Á×ªÈÕÆÚ¸ñÊ½
		foreach($xlsData as $key=>$val){
			$xlsData[$key]['addtime'] = date('Y-m-d H:i:s',$xlsData[$key]['addtime']);
		}
        exportExcel($xlsName,$xlsCell,$xlsData);
    }

}