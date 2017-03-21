<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/21
 * Time: 16:07
 */
date_default_timezone_set("PRC");
//获取当前月的第一天
echo strtotime(date("Ym01"));
echo "<hr>";
$firstDay = date("Ym01");
//获取当前月的最后一天
echo strtotime(date("Ymd",strtotime("$firstDay + 1 month - 1 day")));
echo "<hr>";
//当前月的最后一天
echo date('Y-m-t');//注意：是t，不是d.