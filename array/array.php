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
$condition['order_type'] = array('neq',5); //
$condition['err_status'] = array('gt',0);
echo "<pre>";
print_r($condition);
echo "</pre>";