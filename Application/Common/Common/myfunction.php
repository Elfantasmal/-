<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

/**
 * Think 系统函数库
 */


    /**
     * 登录密码加密
     * @author: 亮 <chenjialiang@han-zi.cn>
     */
    function encrypt_password($string,$salt){
        return md5(sha1($string.$salt));
    }

    /**
     * 获取随机字符
     * @param int $length 长度
     * @return string
     */
    function get_rand_char($length){
        $str = null;
        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $max = strlen($strPol)-1;

        for($i=0;$i<$length;$i++){
            $str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
        }

        return $str;
    }
    /**
     * 生成树递归帮助类
     * @author: 凌翔 <553299576@qq.com>
     * @DateTime 2016-04-21T16:52:26+0800
     * @param    [type]                   $categorys [description]
     * @param    integer                  $catId     [description]
     * @param    string                   $name      [description]
     * @param    integer                  $level     [description]
     * @return   [type]                              [description]
     */
    function get_subs($auth,$pid=0, $name = 'child',$level=1){
        $subs=array();
        foreach($auth as $item){
            if($item['pid']==$pid){
               $item['level']=$level;
               $item[$name]=get_subs($auth,$item['auth_id'],$name,$level+1);
               $subs[]=$item;
            }

        }
        return $subs;
    }

    /**
     * 公众号账户密码加密算法
     * @author: 凌翔 <553299576@qq.com>
     * @DateTime 2016-04-22T11:35:02+0800
     * @param    [string]                   $data [明文密码]
     * @param    [string]                   $key  [秘钥]
     * @return   [string]                         [加密密码]
     */
    function encrypt($data, $key)
    {
        $key = md5($key);
        $x = 0;
        $len = strlen($data);
        $l = strlen($key);
        $char = '';
        $str = '';
        for ($i = 0; $i < $len; $i++)
        {
            if ($x == $l)
            {
                $x = 0;
            }
            @$char .= $key{$x};
            $x++;
        }
        for ($i = 0; $i < $len; $i++)
        {
            @$str .= chr(ord($data{$i}) + (ord($char{$i})) % 256);
        }
        return base64_encode($str);
    }

    /**
     * 公众号账户密码解密算法
     * @author: 凌翔 <553299576@qq.com>
     * @DateTime 2016-04-22T11:49:43+0800
     * @param    [string]                   $data [加密密码]
     * @param    [string]                   $key  [秘钥]
     * @return   [string]                         [解密明文密码]
     */
    function decrypt($data, $key)
    {
        $key = md5($key);
        $x = 0;
        $data = base64_decode($data);
        $len = strlen($data);
        $l = strlen($key);
        $char='';
        $str='';
        for ($i = 0; $i < $len; $i++)
        {
            if ($x == $l)
            {
                $x = 0;
            }
            @$char .= substr($key, $x, 1);
            $x++;
        }
        for ($i = 0; $i < $len; $i++)
        {
            if (ord(substr($data, $i, 1)) < ord(substr($char, $i, 1)))
            {
                $str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
            }
            else
            {
                @$str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
            }
        }
        return $str;
    }
    /**
     * 生成图文素材分类树递归帮助类
     * @author: 元翔 <503931578@qq.com>
     */
    function get_subs_category($category,$pid=0, $name = 'child',$level=1){
        $subs=array();
        foreach($category as $item){
            if($item['pid']==$pid){
               $item['cat_level']=$level;
               $item[$name]=get_subs_category($category,$item['category_id'],$name,$level+1);
               $subs[]=$item;
            }
        }
        return $subs;
    }

    /**
     * 二维数组转换为一维数组并去重
     * @author: 凌翔 <553299576@qq.com>
     * @DateTime 2016-04-29T12:27:02+0800
     * @param    [array]                  $arr  [二维]
     * @param    [bool]                   $type [是否去重,true去重false不去重]
     * @return   [array]                         [二维]
     */
    function array_change($arr,$type=false){
        //将$arr二维数组转换为一维数组
        $new_arr = array();
        foreach($arr as $key => $val) {
            //var_dump( $val);exit;
            foreach($val as $value) {
                $new_arr[] = $value;
            }
        }
        if ($type) {
            //去除重复的键值(去重)
            $new_arr = array_unique($new_arr);
        }
        return $new_arr;
    }

    /**
     * 二维数组排序算法
     * @author: 凌翔 <553299576@qq.com>
     * @DateTime 2016-05-06T20:03:38+0800
     * @param    [array]                   $arr   [待排序的数组]
     * @param    [string]                  $field [排序字段]
     * @param    [string]                  $sort  [正序SORT_ASC,倒顺SORT_DESC]
     * @return   [array]                          [排序完成数组]
     */
    function array_sort($arr,$field,$sort){
        $f = array();
        foreach ($arr as $v) {
            $f[] = $v[$field];
        }

        array_multisort($f, $sort, $arr);
        return $arr;
    }

    function coupons_type($type){
        switch ($type) {
            case '1':
                return 'GROUPON';
                break;
            case '2':
                return 'CASH';
                break;
            case '3':
                return 'DISCOUNT';
                break;
            case '4':
                return 'GIFT';
                break;
            case '5':
                return 'GENERAL_COUPON';
                break;
        }
        throw new HelpersErrorException ('无效卡劵类型','COUPONS_TYPE_FIAL');
    }

    /**
     * 递归数算法
     * @param array $items 传入一维数组
     * @param string $id_name id名称
     * @param string $pid_name 父级id名称
     * @param string $children_name 子级名称
     * @return array
     */
    function generate_tree($items,$id_name='id',$pid_name='parent_id',$children_name='children'){
        $items_new = array();
        foreach ($items as $item) {
            $items_new[$item[$id_name]] = $item ;
        }
        $items = $items_new ;unset($items_new);
        $tree = array();
        foreach($items as $item){
            if(isset($items[$item[$pid_name]])){
                $items[$item[$pid_name]][$children_name][] = &$items[$item[$id_name]];
            }else{
                $tree[] = &$items[$item[$id_name]];
            }
        }
        return $tree;
    }

    /**
     * 将json的stdClass Object转成数组array
     * @author: 凌翔 <553299576@qq.com>
     * @DateTime 2016-06-20T13:46:57+0800
     * @param    [type]                   $array [description]
     * @return   [type]                          [description]
     */
    function object_array($array){
      if(is_object($array)){
        $array = (array)$array;
      }
      if(is_array($array)){
        foreach($array as $key=>$value){
          $array[$key] = object_array($value);
        }
      }
      return $array;
    }


    //生成唯一字符串
    function create_sn() {
        $code = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $rand = $code[rand(0,25)]
        .strtoupper(dechex(date('m')))
        .date('d').substr(time(),-5)
        .substr(microtime(),2,5)
        .sprintf('%02d',rand(0,99));
        for(
                $a = md5( $rand, true ),
                $s = '0123456789ABCDEFGHIJKLMNOPQRSTUV',
                $d = '',
                $f = 0;
        $f < 8;
        $g = ord( $a[ $f ] ),
        $d .= $s[ ( $g ^ ord( $a[ $f + 8 ] ) ) - $g & 0x1F ],
        $f++
        );
        return $d;
    }

    /**
     * 生成订单号(14位)
     * @author jieyang
     */
    function getOrderNumber() {
        $rand = rand(100000,999999);
        return date('ymdHi').$rand;
    }


    //二维数组去掉重复值 
    function array_unique_fb($array2D){ 
        foreach ($array2D as $v) { 
            $v = join(",",$v); //降维,也可以用implode,将一维数组转换为用逗号连接的字符串 
                $temp[] = $v; 
        } 
        $temp = array_unique($temp); //去掉重复的字符串,也就是重复的一维数组 
        foreach ($temp as $k => $v){ 
            $temp[$k] = explode(",",$v); //再将拆开的数组重新组装 
        } 
        return $temp; 
    } 

