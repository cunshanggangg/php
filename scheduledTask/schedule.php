<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/13
 * Time: 8:09
 */
date_default_timezone_set("PRC");
$time = time();
$date = date("Y-m-d H:i:s",$time);
$str = "时间戳：".$time."\n"."北京时间：".$date."\n";
//echo $date;
#1.file_put_contents:参数FILE_APPEND为叠加内容
//file_put_contents("content.txt",$str,FILE_APPEND);

#2.fopen,fputs,fclose
//$fp = fopen("content.txt","a");
//fputs($fp,$str);
//fclose($fp);

#3.fopen,fwrite,fclose
$fg = fopen("content.txt","a+");
fwrite($fg,$str);
fclose($fg);
