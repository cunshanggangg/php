<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/3
 * Time: 14:21
 */
require_once 'class/medoo.php';
$medoo = array(

);
$database = new medoo([
    //必需
    'database_type'=>'mysql',
    'database_name'=>'jdpt1',      //数据库名称
    'server'=>'localhost',       //数据库连接地址
    'username'=>'root',  //用户名
    'password'=>'',  //密码
    'charset'=>'utf8',            //数据库编码
    // [可选的] 数据库连接端口
    'port'=> 3306,
    // [可选]表前缀
    'prefix'=>'shopnc_',
    // [可选]用于连接的driver_option，阅读更多从http://www.php.net/manual/zh/pdo.setattribute.php
    'option'=> [PDO :: ATTR_CASE => PDO :: CASE_NATURAL]
]);

//$database->debug()->select("ypl_member","*",["addr[~]" => "%附近"]);
$result = $database->select("ypl_member","*",["addr[~]" => "%附近"]);
//echo "<pre>";
//print_r($result);
//echo "<hr>";
foreach($result as $key => $value) {
    $str = rand(1,20)."栋".rand(1,10)."单元".rand(1,3).rand(0,5).rand(0,9)."室";
    $str1 = '号'.rand(1,20)."栋".rand(1,10)."单元".rand(1,3).rand(0,5).rand(0,9)."室";
    $str2 = rand(1,10)."单元".rand(1,3).rand(0,5).rand(0,9)."室";
    $value['addr'] = mb_substr($value['addr'],0,-2,'utf-8');
    $last = mb_substr($value['addr'],-1,1,'utf-8');
//    echo $last;
//    echo "<hr>";
    if(is_numeric($last)) {
//        echo $value['user_id'];echo "<hr>";
        $value['addr'] = $value['addr'].$str1;
    } else if($last == "幢") {
        $value['addr'] = $value['addr'].$str2;
    } else if($last == "室" || $last == "号") {
//        echo $last;echo $key;
//        echo "<hr>";
        $value['addr'];
    } else{
        $value['addr'] = $value['addr'].$str;
    }
    $result[$key]['addr'] = $value['addr'];
}
echo "<pre>";
print_r($result);
//更新到数据库
//foreach($result as $k => $v) {
//    $database->update("ypl_member",array(
//        "addr" => $v['addr']
//    ),array(
//        "user_id" => $v['user_id']
//    ));
//}
