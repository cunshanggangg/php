<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/22
 * Time: 10:07
 */
//array_diff()：比较两个数组的键值，并返回差集
$arr1 = array("a" => "yaoMing","b" => "liNa","c" => "liuXiang","d" => "sunYang","e" => "linDan");
$arr2 = array("f" => "yaoMing","g" => "liNa","h" => "liuXiang");
$result = array_diff($arr1,$arr2);
echo "<pre>";
print_r($result);
