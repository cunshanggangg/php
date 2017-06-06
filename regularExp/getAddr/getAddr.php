<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/6
 * Time: 19:06
 */
$str = file_get_contents("http://haoweichi.com/Others/ri_ben_ren_shen_fen_zi_liao");
//file_put_contents("data.txt",$str);
//echo "<pre>";
//print_r($str);
//echo "</pre>";
//preg_match_all("|value='(.*)'|isU",$str,$result);
$preg = "<input type=\"text\" value='(.*)' class='color5'/>";
preg_match_all($preg,$str,$result);
//echo "<pre>";
//print_r($result);
//echo "</pre>";
file_put_contents("address.txt",$result[1][0].PHP_EOL,FILE_APPEND);
echo "<script>window.location.reload();</script>";