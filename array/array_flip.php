<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/30
 * Time: 15:14
 */
//交换数组的键和值

$arr = array("name"=>"yaoMing","liNa","liuXiang");
$res = array_flip($arr);

echo "<pre>";
print_r($res);
echo "</pre>";
