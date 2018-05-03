<?php
/**
 * Created by PhpStorm.
 * User: linjiabei
 * Date: 2018/5/3
 * Time: 19:21
 */
$str = "2018-3-26 下午 12:01:50";
$stamp = strtotime(str_replace(" 下午 "," ",$str));
$hour = date('h',$stamp);
//echo $hour;

if($hour != 12) {
    $stamp = strtotime(str_replace(" 下午 "," ",$str))+60*60*12;
}