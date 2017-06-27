<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/29
 * Time: 14:26
 */
//往数组里添加一个元素
$arr = array("name"=>"yaoMing","sex"=>"male");
$arr1 = array("year"=>"35");
array_push($arr,$arr1);
echo "<pre>";
print_r($arr);
echo "</pre>";
echo "<hr>";
$zhan=array("WEB");//声明一个数组当做队列
array_push($zhan,"PHP");//将字符串压入栈（数组）中
array_push($zhan,"WWW.CHHUA.COM");//再压入一个元素
echo "<pre>";
print_r($zhan);//打印数组内容