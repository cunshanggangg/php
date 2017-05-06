<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/2
 * Time: 17:33
 */
//echo "<pre>";
//print_r($_POST);
//echo "</pre>";
//exit($_POST);

//$sum = $_POST['num']+10;
//echo $sum;
//exit($sum);
//return $sum;
//echo $_POST['num'];
//echo $_POST['name'];
//echo $_POST['num']+10;
//$arr = array("linn","dddddddddd");
//exit(print_r($arr));

//if($_POST['num'] == '') {

//}
error_reporting();
$conn = mysql_connect("localhost","root","") or die("MySQL连接失败！");
$db = mysql_select_db("ceshi",$conn) or die("数据库连接失败！");
mysql_query("set names 'utf8'");

$sql = "select * from `ecs_num` where id=1";
$res = mysql_query($sql) or die(mysql_error());

while($row = mysql_fetch_array($res)) {
//    echo $row['id'];
//    echo "<br />";
    $num = $row['num'];
}
mysql_close($conn);
//exit($_POST);
if($_POST['num'] == ''){
    $_POST['num'] = $num;
}else{
    $_POST['num'] = $_POST['num']+10;
}
exit(json_encode($_POST));
//exit(print_r($_POST));
//print_r($_POST);