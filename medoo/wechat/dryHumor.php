<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/20
 * Time: 23:31
 */
require '../class/medoo.php';
$str = file_get_contents('dryHumor.txt');
preg_match_all("/.*\s/",$str,$r);
//echo "<pre>";
//print_r($r);
//echo "</pre>";
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
$time = time();
//foreach ($r[0] as $k=>$v) {
//    $database->insert("dry_humor",['content'=>"$v",'time'=>"$time"]);
//}
$id = rand(1,80);
$res = $database->select("dry_humor","*",['id'=>"$id"]);
echo "<pre>";
print_r($res[0]['content']);
echo "</pre>";