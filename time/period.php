<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/28
 * Time: 0:01
 */
date_default_timezone_set("PRC");
$s = '2017-02-05';
$e = '2017-02-21';

$start    = new \DateTime($s);
$end      = new \DateTime($e);
// 时间间距 这里设置的是一个月
$interval = \DateInterval::createFromDateString('1 day');
$period   = new \DatePeriod($start, $interval, $end);

$timeStamp = array();
foreach ($period as $dt) {
    echo $dt->format("Y-m-d") . "<br>\n";
    array_push($timeStamp,strtotime($dt->format("Y-m-d")));
}

echo "<pre>";
print_r($timeStamp);
echo "</pre>";
