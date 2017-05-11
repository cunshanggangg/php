<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/11
 * Time: 15:17
 */
include_once 'pinyin.php';

$conn = mysql_connect("localhost","root","") or die("MySQL连接不上！");
$db = mysql_select_db("ceshi1",$conn) or die("数据库连接失败！");
mysql_query("set names 'utf8'");

$sql = "select * from ecs_region";
$result = mysql_query($sql) or die(mysql_error());
$region = array();
$all_region = array();
while($row = mysql_fetch_array($result)) {
//    echo "<pre>";
//    print_r($row);
//    echo "</pre>";
//    $res = $row['region_name'];
    $region[$row['region_id']][0] = $row['region_name'];
    $res = pinyin($row['region_name']);
    $region[$row['region_id']][1] = $res;
//    array_push($region,$region);
//    array_push($all_region,$region);
}

echo "<pre>";
//print_r($all_region);
print_r($region);
echo "</pre>";
