<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/26
 * Time: 17:27
 */
require_once '../class/medoo.php';
$database = new medoo([
    //必需
    'database_type'=>'mysql',
    'database_name'=>'tp',      //数据库名称
    'server'=>'localhost',       //数据库连接地址
    'username'=>'root',  //用户名
    'password'=>'',  //密码
    'charset'=>'utf8',            //数据库编码
    // [可选的] 数据库连接端口
    'port'=> 3306,
    // [可选]表前缀
    'prefix'=>'',
    // [可选]用于连接的driver_option，阅读更多从http://www.php.net/manual/zh/pdo.setattribute.php
    'option'=> [PDO :: ATTR_CASE => PDO :: CASE_NATURAL]
]);
$str = file_get_contents("../data/undercover.txt");
//echo $str;
//$regex = "/.*/";
//$regex = "/(.*)/";
//preg_match_all($regex,$str,$r);
$r  = explode(",,",$str);
//echo "<pre>";
//print_r($r);
//echo "</pre>";
//$d = explode("——",$r[0]);
//echo "<pre>";
//print_r($d);
//echo "</pre>";
//echo $d[0];
foreach($r as $k=>$v) {
//    echo "<pre>";
//    print_r($v);
//    echo "</pre>";
    $d = explode("——",$v);
//    foreach($d as $k1=>$v2) {
//        echo "<pre>";
//        print_r($v2);
//        echo $v2;
//        echo "</pre>";
//        echo "<hr>";
//        echo "$v2";
    $database->insert("undercover",["spy"=>"$d[0]","folk"=>"$d[1]"]);
//    echo "<pre>";,"status"=>0,"luck_nubmer"=>0
//    print_r($v);
//    echo "</pre>";
//    echo $v[0].$v[1];
//    echo "<hr>";
//    }

}
/*
foreach($r as $k=>$v) {
    $d = explode("——",$v);
    foreach($d as $key=>$value){
//        echo "<pre>";
//        print_r($value);
//        echo "</pre>";
//        $s = $value[0];
//        $f = $value[1];
        $database->debug()->insert("underover",["spy"=>$value[0],"folk"=>$value[1]]);
//        $sql = "inser into `undercover` ('spy','folk') values (".$value[0].','.$value[1].')';
//        echo $sql;
//        echo "<br>";
//        echo "<pre>";
//        print_r();
//        echo "</pre>";
    }
}
*/

