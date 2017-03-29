<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/29
 * Time: 14:42
 */
//将数组分割成几个数组，
//$arr = array("name"=>"yaoMing","sex"=>"male","year"=>"35");
$arr = array("0"=>"a","1"=>"b","2"=>"c");
$res = array_chunk($arr,2,true);//加true会保留索引值，不加则不会保留索引值
echo "<pre>";
print_r($res);
echo "</pre>";