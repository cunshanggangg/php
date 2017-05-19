<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/19
 * Time: 22:44
 */
require_once 'class/medoo.php';
$medoo = array(

);
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

//测试插入一条数据
//$database->insert('student',array(
//    "name" => "林书豪",
//    "age" => "28",
//    "sex" => "0"
//));
//打印SQL语句
//$database->debug()->insert('tp_student',array(
//    "name" => "林书豪",
//    "age" => "28",
//    "sex" => "0"
//));
////打印错误信息
//$database->insert('tp_student',array(
//    "name" => "林书豪",
//    "age" => "28",
//    "sex" => "0"
//));

//echo "<pre>";
//var_dump($database->error());//表“tp_student”多了前缀
//echo "</pre>";

//直接调用，打印输出即可
echo "<pre>";
print_r($database->info());
echo "</pre>";

