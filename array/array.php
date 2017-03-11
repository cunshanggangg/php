<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/14
 * Time: 13:58
 */

//$arr = array();
//$arr[] = 'Hello World';
//print_r($arr);

$condition  = array();
$condition['order_type'] = array('neq',5);  //  1无会员,3已分配会员  4多订单 5是附属商品订单 6,关闭与取消
$condition['err_status'] = array('gt',0);
echo "<pre>";
print_r($condition);
echo "</pre>";