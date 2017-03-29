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