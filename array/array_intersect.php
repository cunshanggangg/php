<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/22
 * Time: 9:39
 */
//array_intersect：比较两个数组的键值，并返回交集
$arr1 = array("a" => "yaoMing","b" => "liNa","c" => "liuXiang","d" => "sunYang","e" => "linDan");
$arr2 = array("f" => "yaoMing","g" => "liNa","h" => "liuXiang","i" => "maLong","j" => "zhangJiKe");
$result = array_intersect($arr1,$arr2);
echo "<pre>";
print_r($result);