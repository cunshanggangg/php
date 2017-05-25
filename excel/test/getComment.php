<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/25
 * Time: 16:23
 */
$conn = mysql_connect("localhost","root","") or die("MySQL连接不上！");
$db = mysql_select_db("jdpt",$conn) or die("数据库连接失败！");
mysql_query("set names 'utf8'");

$sql = "SHOW FULL COLUMNS FROM shopnc_order_import";
$result = mysql_query($sql) or die(mysql_error());

$row = mysql_fetch_assoc($result);
$table_comment = array();

while($row = mysql_fetch_assoc($result)) {
    $table_comment[] = $row['Comment'];
}
echo "<pre>";
print_r($table_comment);
echo "</pre>";

