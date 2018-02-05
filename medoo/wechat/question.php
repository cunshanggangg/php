<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/5
 * Time: 23:00
 */
require_once "../class/medoo.php";
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
$str = file_get_contents("../data/question1.txt");
//echo $str;
$regx = "/.*\r\n/";
preg_match_all($regx,$str,$m);
//echo "<pre>";
//print_r($m);
//echo "</pre>";
//foreach($m[0] as $k=>$v) {
//    $database->insert("true_or_dare",["type"=>3,"content"=>"$v","times"=>1]);
//}

//$r = $database->count("true_or_dare",["type"=>1]);
//$ids = $database->select("true_or_dare","id",["type"=>1]);
//$id = $ids[array_rand($ids,1)];
//echo $id;
//echo "<pre>";
//print_r();
//echo "</pre>";