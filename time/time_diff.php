<?php
/**
 * Created by PhpStorm.
 * User: linjiabei
 * Date: 2018/6/5
 * Time: 18:26
 */
//php计算两个时间相差的天数、小时数、分钟数、秒数
$startdate="2018-06-04 00:05:10";

$enddate="2018-06-05 07:12:12";

$date=floor((strtotime($enddate)-strtotime($startdate))/86400);
echo "相差天数：".$date."天<br/><br/>";

//$hour=floor((strtotime($enddate)-strtotime($startdate))%86400/3600);
$hour=number_format((strtotime($enddate)-strtotime($startdate))%86400/3600,1);
echo "相差小时数：".$hour."小时<br/><br/>";

$minute=floor((strtotime($enddate)-strtotime($startdate))%86400/60);
echo "相差分钟数：".$minute."分钟<br/><br/>";

$second=floor((strtotime($enddate)-strtotime($startdate))%86400%60);
echo "相差秒数：".$second."秒";

echo "<hr>";
$test = number_format((1528154745-1528045845)%86400/3600,1);
echo "相差小时数：".$test."小时<br/><br/>";