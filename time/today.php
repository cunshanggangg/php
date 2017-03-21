<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/21
 * Time: 15:04
 */
date_default_timezone_set("PRC");
//获取当天凌晨的时间戳
echo date('Ymd');
echo "<hr>";
echo strtotime(date('Ymd'));
echo "<hr>";
echo "使用小写date('ymd')：";
echo "<br>";
echo date("ymd");
echo "<br>";
echo "使用小写date('ymd')时间戳:";
echo "<br>";
echo strtotime(date('ymd'));
echo "<hr>";
//获取明天凌晨的时间戳
echo strtotime(date("Ymd",strtotime("+1 days")));