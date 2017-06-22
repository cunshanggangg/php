<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/22
 * Time: 10:20
 */
//array_diff_assoc() ：比较两个数组的键和值，并返回差集
$arr1 = array("a" => "yaoMing","b" => "liNa","c" => "liuXiang","d" => "sunYang","e" => "linDan");
$arr2 = array("a" => "yaoMing","b" => "liNa","c" => "liuXiang");
$result = array_diff_assoc($arr1,$arr2);
echo "<pre>";
print_r($result);