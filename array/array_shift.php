<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/29
 * Time: 14:19
 */
//删除数组的第一个元素
$arr = array("name"=>"yaoMing","sex"=>"male");
array_shift($arr);
echo "<pre>";
print_r($arr);
echo "</pre>";
echo "<hr>";
$zhan=array("WEB","www.chhua.com","WEB开发笔记","PHP","网站建设");//声明一个数组当做栈
array_shift($zhan);//将字符串出队（数组）中
echo "<pre>";
print_r($zhan);
