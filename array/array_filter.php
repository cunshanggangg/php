<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/30
 * Time: 9:46
 */
//奇数
function odd($n) {
    //判断输入的整数是否为奇数
    return ($n & 1);
}

//偶数
function even($n) {
    //判断输入的整数是否为偶数
    return (!($n & 1));
}

$arr = array(1,2,3,4,5,6,7,8,9,10);

//$res = array_filter($arr,'odd');
//echo "<pre>";
//print_r($res);//结果：1,3,5,7,9
//echo "</pre>";

$res = array_filter($arr,'even');
echo "<pre>";
print_r($res);//结果：2,4,6,8,10
echo "</pre>";

echo "<hr>";

echo "<pre>";
//将关联数组变成索引数组
print_r(array_values($res));
echo "</pre>";