<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/20
 * Time: 15:52
 */
require_once "conn.php";
$str = file_get_contents('cardNo.txt');
//echo "<pre>";
//print_r($str);
//echo "</pre>";
$match = array();
preg_match_all("/(.*?)(\\s)/",$str,$match);
//echo "<pre>";
//print_r($match[0]);
//echo "</pre>";

$out = array_chunk($match[0],12);//每十个元素组成一个新的数组元素

for($i=0;$i<count($out);$i++) {//将数组的最后一个空元素删除
    array_pop($out[$i]);
}
//echo "<pre>";
//print_r($out);
//echo "</pre>";

foreach($out as $k=>$v) {//将银行卡号重新放到一个数组中去
    $res[] = $v[2];
}
$c = count($res);
//echo "<pre>";
//print_r($res);
//echo "</pre>";
//echo $c;
//echo "<hr>";
//拼接字符串
$s = "";
foreach($res as $k=>$v) {
    $v = trim($v);
    $s .= $v.",";
}
echo $s;

$outStr = '';
foreach($res as $k1=>$v1) {
    $v2 = trim($v1);
     $outStr.="'$v2'".",";
//    echo $v2;
//    echo "<br />";
}
//获得余额数
//foreach($out as $k=>$v) {
//    echo trim($v[10]);
//    echo "<br />";
//}
//获取银行卡号和余额
$res3 = array();
foreach($out as $k7 => $v7) {
    $res3[$k7][0] = $v7[2];
    $res3[$k7][1] = $v7[10];
}

//echo "<pre>";
//print_r($res3);
//echo "</pre>";

//echo $outStr;//拼接SQL语句

/*-----------------------------获取user_id start------------------------*/

$str1 = file_get_contents('user_id.txt');
//echo "<pre>";
//print_r($str1);
//echo "</pre>";
$match1 = array();
preg_match_all("/(.*?)(\\s)/",$str1,$match1);
//echo "<pre>";
//print_r($match1[0]);
//echo "</pre>";

$out1 = array_chunk($match1[0],2);

//echo "<pre>";
//print_r($out1);
//echo "</pre>";

for($j=0;$j<count($out1);$j++) {
    array_pop($out1[$j]);
}

//echo "<pre>";
//print_r($out1);
//echo "</pre>";

foreach($out1 as $k3=>$v3) {
    $res2[] = $v3[0];
}

//echo "<pre>";
//print_r($res2);
//echo "</pre>";
$outStr1 = '';
//echo count($res2);
//echo "<hr>";
foreach($res2 as $k4=>$v4) {
    $v5 = trim($v4);
    $outStr1 .= "'$v5'".',';
//    echo $v5;
//    echo "<br />";
}

//echo $outStr1;
/*---------------------获取user_id end-----------------------*/

/*---------------------获取个人信息 start---------------------*/
$str3 = file_get_contents("info.txt");
//echo "<pre>";
//print_r($str3);
//echo "</pre>";

preg_match_all("/(.*?)(\\s)/",$str3,$match2);

//echo "<pre>";
//print_r($match2[0]);
//echo "</pre>";

$out2 = array_chunk($match2[0],6);

//echo "<pre>";
//print_r($out2);
//echo "</pre>";

//去除最后一个空元素
//$r = array_filter($out2);
//echo "<pre>";
//print_r($r);
//echo "</pre>";
for($i=0;$i<count($out2);$i++) {
    array_pop($out2[$i]);
}

//echo "<pre>";
//print_r($out2);
//echo "</pre>";
//将银行卡和余额压进数组中
foreach($res3 as $k8=>$v8) {
    foreach($v8 as $k9=>$v9){
        array_push($out2[$k8],$v9);
    }
}

//echo "<pre>";
//print_r($out2);
//echo "</pre>";
/*---------------------获取个人信息 end---------------------*/

/*---------------------插入数据库 start --------------------*/
//测试 start
//$sql = "select * from tp_student";
//$result = mysql_query($sql);
//while($row = mysql_fetch_row($result)) {
//    echo $row[0].$row[1].$row[2].$row[3];
//}

//while($row = mysql_fetch_array($result)) {
//    echo $row['id'].' '.$row['name'].' '.$row['age'].' '.$row['sex'].'<br />';
//}
//测试 end

//foreach($out2 as $k10=>$v10) {
//    $sql = "insert into tp_info (`user_id`,`name`,`id_card`,`address`,`addr_code`,`bank_no`,`money`)values($v10[0],'$v10[1]','$v10[2]','$v10[3]','$v10[4]','$v10[5]','$v10[6]')";
//    mysql_query($sql);
//}
/*---------------------插入数据库 end ---------------------*/
