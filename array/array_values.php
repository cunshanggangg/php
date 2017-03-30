<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/30
 * Time: 10:06
 */
$arr = array("name"=>"yaoMing","sex"=>"male");

//将关联数组变成索引数组
$res = array_values($arr);

echo "<pre>";
print_r($res);//0=>yaoMing,1=>male
echo "</pre>";