<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/31
 * Time: 15:11
 */
$arr = array(
    'name(user)' => 'yaoMing',
    'password(psd)' => '123456'
);

echo "<pre>";
print_r($arr);

$conn = mysql_connect("localhost","root","") or die("MySQL连接不上！");
$db = mysql_select_db("tp",$conn) or die("数据库连接失败！");
mysql_query("set names 'utf8'");

$sql = "select 'name(user)' from tp_student";
echo $sql;
