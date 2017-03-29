<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/29
 * Time: 14:21
 */
//往数组添加一个元素
$arr = array("name"=>"yaoMing","sex"=>"male");
$arr1 = array("year"=>"35");
array_unshift($arr,$arr1);
echo "<pre>";
print_r($arr);
echo "</pre>";