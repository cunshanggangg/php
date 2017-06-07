<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/7
 * Time: 9:45
 */
//$str = file_get_contents("http://haoweichi.com/Index/random");
$str = file_get_contents("http://www.haoweichi.com/Others/ying_guo_shen_fen_sheng_cheng");
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
//拼装英国人的地址：街道,市,邮编
$address = $result[1][9].','.$result[1][10].','.' '.$result[1][12];
//echo $address;
file_put_contents("data/UK.txt",$address.PHP_EOL,FILE_APPEND);
echo "<script>window.location.reload();</script>";