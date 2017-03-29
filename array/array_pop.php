<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/29
 * Time: 14:30
 */
//删除数组的最后一个
$arr = array("name"=>"yaoMing","sex"=>"male");
array_pop($arr);
echo "<pre>";
print_r($arr);
echo "</pre>";