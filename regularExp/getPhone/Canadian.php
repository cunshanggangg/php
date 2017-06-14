<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/6
 * Time: 19:06
 */
$str = file_get_contents("http://haoweichi.com/Others/jia_na_da_shen_fen_sheng_cheng");
//file_put_contents("data.txt",$str);
//echo "<pre>";
//print_r($str);
//echo "</pre>";
//preg_match_all("|value='(.*)'|isU",$str,$result);
//$preg = "<input type=\"text\" value='(.*)' class='color5'/>";
$preg1 = "<input type=\"text\" value='(.*?)'>";#可用
//$preg1 = "{<input(\s+(name|type|value)=\"(.*)\")+\s*/>}";
//$preg1= "";
//preg_match_all($preg,$str,$result);
preg_match_all($preg1,$str,$result);
//echo "<pre>";
//print_r($result);
//echo "</pre>";exit;
$phone = $result[1][10];
echo $phone;
file_put_contents("data/Canadian.txt",$phone.PHP_EOL,FILE_APPEND);
echo "<script>window.location.reload();</script>";