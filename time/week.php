<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/21
 * Time: 16:02
 */
//设定中国时区
date_default_timezone_set("PRC");
//获取当前周的第一天
echo date('Y-m-d', strtotime('this week'));
echo "<hr>";
//获取当前周的最后一天
echo date('Y-m-d', strtotime('this week + 6 days'));
echo "<hr>";
//获取当前周的第一天的时间戳
echo strtotime(date('Y-m-d', strtotime('this week')));
echo "<hr>";
//获取当前周的最后一天的时间戳
echo strtotime(date('Y-m-d', strtotime('this week + 6 days')));
//获取星期几
echo "<hr>";
echo date('w','1524999600');