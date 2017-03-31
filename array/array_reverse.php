<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/3
 * Time: 17:22
 */
$arr = array('a','b','c','d');
echo "<pre>";
print_r($arr);
echo "</pre>";
echo "<hr>";
echo "<pre>";
$arr = array_reverse($arr);
print_r($arr);
echo "</pre>";
echo "<hr>";
$a=array("a"=>"Volvo","b"=>"BMW","c"=>"Toyota");
echo "<pre>";
print_r(array_reverse($a));//关联数组保留了键值
echo "</pre>";