<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/28
 * Time: 15:48
 */
//$keyword = "李连杰";
//$join_time = "2018-01-28 14:29:20";
//$contentStr = "localhost/php/medoo/wechat/show.php?keyword=".urlencode($keyword)."&time=".urlencode($join_time);
//echo $contentStr;

$time = date("Y-m-d H:i:s");
echo $time;
echo "<hr>";
$urlEncode = urlencode($time);
echo $urlEncode;
echo "<pre>";
echo "</pre>";

