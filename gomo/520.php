<?php
/**
 * Created by PhpStorm.
 * User: linjiabei
 * Date: 2018/5/17
 * Time: 19:56
 */
//当前时间
$now = time();
//5月20凌晨
$start = strtotime("2018-05-20 00:00:00");
//5月20结束
$end = strtotime("2018-05-21 00:00:00");
if($now>$start && $now<$end) {
    echo "亲，520快乐！";
}else{
    echo "亲，520还没有到哦！";
}