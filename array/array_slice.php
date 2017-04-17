<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/29
 * Time: 14:51
 */
//从一个数组取出一段
$arr = array(
    "0"=>"a",
    "1"=>"b",
    "2"=>"c",
    "3"=>"d"
);

echo "<pre>";
print_r(array_slice($arr,1,3,true));//true显示原来的索引值
echo "</pre>";

echo "<pre>";
print_r($arr);
echo "</pre>";

echo "与array_splice()的区别\n";
$arr1 = array(
    "0"=>"a",
    "1"=>"b",
    "2"=>"c",
    "3"=>"d"
);
echo "<pre>";
print_r(array_splice($arr1,1,3));
echo "</pre>";

echo "<pre>";
print_r($arr1);
echo "</pre>";

/* 与array_splice()区别：
 *
 * array_splice()：分割后数组分成两部分
 *
 * array_slice():获取到分割部分，但原数组仍然保持原来的数据
 *
 * */
