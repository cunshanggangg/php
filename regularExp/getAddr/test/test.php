<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/13
 * Time: 9:27
 */
$str = file_get_contents("detail.txt");
//echo "<pre>";
//echo $str;
//$preg = "/^(\\d{6})(\\d{4})(\\d{2})(\\d{2})(\\d{3})([0-9]|X)/m";
$preg = "/1[3,4,5,7,8]\d{9}/";
preg_match_all($preg,$str,$res);
echo "<pre>";
print_r($res);