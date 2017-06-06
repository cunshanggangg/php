<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/6
 * Time: 19:06
 */
$str = file_get_contents("http://haoweichi.com/Index/random");
//file_put_contents("data.txt",$str);
//echo "<pre>";
//print_r($str);
//echo "</pre>";
//preg_match_all("|value='(.*)'|isU",$str,$result);
//$preg = "<input type=\"text\" value='(.*)'/>";
$preg = "|value='(.*)'|isU";
preg_match_all($preg,$str,$result);
//echo "<pre>";
//print_r($result);
//echo "</pre>";
//拼装美国人的地址：街道,市,州,邮编
$address = $result[1][12].','.$result[1][13].','.$result[1][11].' '.$result[1][14];
//echo $address;
file_put_contents("USA.txt",$address.PHP_EOL,FILE_APPEND);
echo "<script>window.location.reload();</script>";