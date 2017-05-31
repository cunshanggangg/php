<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/31
 * Time: 15:11
 */
require_once 'class/medoo.php';

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

$result = $database->debug()->select("student",
    array(
        "name(user)",//别名
        "sex"
),
    array(
        "id" => "9"
)
);
//echo "<pre>";
//print_r($result);

//$database->debug()->select("student","name");


