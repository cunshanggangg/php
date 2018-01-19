<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/19
 * Time: 9:16
 */
require_once "../class/medoo.php";
$str = file_get_contents("../data/brainTeaser.txt");
//echo "<pre>";
//print_r($str);
//echo "</pre>";
$regex = "/(.*)\S/";
preg_match_all($regex,$str,$r);
//echo "<pre>";
//print_r($r);
//echo "</pre>";
$res = array_chunk($r[0],2);
//echo "<pre>";
//print_r($res);
//echo "</pre>";exit;
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
//foreach($res as $k=>$v) {
////    echo $v[0].$v[1]."<br>";
//    $question = $v[0];
//    $answer = $v[1];
//   $database->insert("tp_brain_teaser",["question"=>$question,"answer"=>$answer,"time"=>time()]);
//}
$id = rand(1,225);
echo $id;
$r = $database->select("tp_brain_teaser","*",["id"=>$id]);
echo "<pre>";
print_r($r);
echo "</pre>";


