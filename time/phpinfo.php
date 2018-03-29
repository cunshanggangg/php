<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/7
 * Time: 21:10
 */
echo phpinfo();
echo "<pre>";
print_r($_SERVER);
echo "</pre>";
echo "<hr>";
echo "<pre>";
print_r($_SERVER['PATH']);//打印系统的变量
$str = $_SERVER['PATH'];
//windows下获取mysql的安装路径 bin
$res = explode(';',$str);
echo "<pre>";
print_r($res);
echo php_uname();//打印所在的平台的系统的具体的信息
echo php_uname('s');//所在平台的具体的信息