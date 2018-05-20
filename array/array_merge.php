<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/23
 * Time: 14:04
 */
//将一个数组的值作为索引值，另外一个数组作为值，如果两个数组的元素不一致，则报错
//$batchDate[] = "SUBSTRING(batch_no,1,6)";
//$todayDate[] = date('ymd');
//
//$con = array_combine($batchDate,$todayDate);
//
//echo "<pre>";
//print_r($con);
//echo "</pre>";


//将不规则的数组的索引重置
$arr = array(0=>'yaoMing',1=>"liNa",4=>"langPing");
//echo "<pre>";
//print_r($arr);
//echo "</pre>";

//可以用array_values()：返回数组的值；
//$result = array_values($arr);
//echo "<pre>";
//print_r($result);
//echo "</pre>";

//或者用array_merge():将数组重新组合起来，索引值重置。
//注：该函数只能对索引数组起作用，即：索引值为数字，如果是关联数组，则不起作用
$arr['name'] = 'zhuTing';
$res = array_merge($arr);
echo "<pre>";
print_r($res);
echo "</pre>";