<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/24
 * Time: 17:33
 */
$conn = mysql_connect("localhost","root","") or die("MySQL连接不上！");
$db = mysql_select_db("jdpt1",$conn) or die("数据库连接失败！");
mysql_query("set names 'utf8'");

$sql = "select * from shopnc_order_import";
$result = mysql_query($sql) or die(mysql_error());
$student = array();
$i = 0;
$row = mysql_fetch_assoc($result);
//echo "<pre>";
//print_r(array_keys($row));
//echo "</pre>";exit;
$res = array_keys($row);
//$k26 = array_keys($row_keys);
$all_keys = array_splice($res,0,30);
//echo "<pre>";
//print_r($all_keys);
//echo "</pre>";exit;
foreach($res as $value) {
    echo $value;
    echo "<hr>";
}
//exit;
while($row = mysql_fetch_array($result)) {
    $student[$i]['id'] = $row['id'];
    $student[$i]['name'] = $row['name'];
    $student[$i]['age'] = $row['age'];
    $student[$i]['sex'] = $row['sex'];
    $i++;
}
echo "<pre>";
print_r($student);