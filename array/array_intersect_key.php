<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/22
 * Time: 9:52
 */
//array_intersect_key：将两个数组的键值进行比较，返回键值交集的数组
$arr1 = array("a" => "yaoMing","b" => "liNa","c" => "liuXiang","d" => "sunYang","e" => "linDan");
$arr2 = array("f" => "yaoMing","g" => "liNa","h" => "liuXiang","i" => "maLong","e" => "zhangJiKe");
$result = array_intersect_key($arr2,$arr1);
echo "<pre>";
print_r($result);