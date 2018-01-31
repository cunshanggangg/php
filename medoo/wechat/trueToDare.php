<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/31
 * Time: 14:58
 */
require_once "../class/medoo.php";
date_default_timezone_set("PRC");
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

/*
//推送 start
$count = $database->count("true_or_dare","*");
//echo "<pre>";
//print_r($count);
//echo "</pre>";
//随机抽取一个
$rand = rand(1,$count);
//echo $rand;
$r = $database->select("true_or_dare","*",["and"=>["id"=>"$rand","type"=>"1"]]);
//echo "<pre>";
//print_r($r);
//echo "</pre>";
$content = $r[0]['content'];
$wxname = "yaoMing";
$time = date("Y-m-d H:i:s");
//次数
$times = ($r[0]['times']+1);
//插入到true_player表中
$database->insert("true_player",["u_id"=>"$rand","wxname"=>"$wxname","content"=>"$content","time"=>"$time"]);
//更新ture_or_dare表的次数
//echo $times;
$database->update("true_or_dare",["times"=>"$times"],["id"=>"$rand"]);
//推送 end
*/

//插入到follow表
$time = date("Y-m-d H:i:s");
$wxname = "liNa";
$r = $database->select("follower","*",["wxname"=>"$wxname"]);
if(empty($r)){
    $database->insert("follower",["wxname"=>"$wxname","time"=>"$time"]);
}


