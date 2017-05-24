<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/24
 * Time: 17:33
 */
$conn = mysql_connect("localhost","root","") or die("MySQL连接不上！");
$db = mysql_select_db("tp",$conn) or die("数据库连接失败！");
mysql_query("set names 'utf8'");

$sql = "select * from tp_student";
$result = mysql_query($sql) or die(mysql_error());
$student = array();
$i = 0;
while($row = mysql_fetch_array($result)) {
    $student[$i]['id'] = $row['id'];
    $student[$i]['name'] = $row['name'];
    $student[$i]['age'] = $row['age'];
    $student[$i]['sex'] = $row['sex'];
    $i++;
}
echo "<pre>";
print_r($student);