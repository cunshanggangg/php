<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/21
 * Time: 15:43
 */
//设定中国时区
date_default_timezone_set("PRC");
//获取当前月的第一天：XXXX年XX月01日
echo date("Ym01");
echo "<hr>";
echo strtotime(date("Ym01"));
echo "<hr>";
//获取下个月的最后一天：XXXX年XX月01日
echo strtotime(date("Ym01",strtotime('+1 month')));