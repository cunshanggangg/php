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
