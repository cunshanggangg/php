<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/8
 * Time: 15:31
 */
require_once 'class/medoo.php';
$str = file_get_contents("data/Japanese.txt");
//echo "<pre>";
//echo $str;
$preg = "/(.*)\r\n/";
preg_match_all($preg,$str,$result);
//echo "<pre>";
//print_r($result[1]);
$res = array_slice($result[1],0,393);//获取393条
//echo "<pre>";
//print_r($res);
//将数组打乱
//shuffle($res);
//echo "<pre>";
//print_r($res);
//连接数据库
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
    'prefix'=>'tp_',
    // [可选]用于连接的driver_option，阅读更多从http://www.php.net/manual/zh/pdo.setattribute.php
    'option'=> [PDO :: ATTR_CASE => PDO :: CASE_NATURAL]
]);

//$japan = $database->debug()->select("member","*",array("country" => "日本"));
$japan = $database->select("member",array("user_id"),array("country" => "日本"));
//echo "<pre>";
//print_r($japan);
//foreach($japan as $key => $value) {
//    echo $value['user_id'];
//    echo "<hr>";
//}
foreach($japan as $key => $value) {
       $database->update("member",array("address" => $res[$key]),array("user_id" => $value['user_id']));
}