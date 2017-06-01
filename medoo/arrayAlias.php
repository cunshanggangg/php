<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/31
 * Time: 15:11
 */
require_once 'class/medoo.php';
// 注意：
// 1.debug()打印出来的sql在数据库不可以直接运行，这个是很大的问题，
$database = new medoo([
    //必需
    'database_type'=>'mysql',
    'database_name'=>'tp',//数据库名称
    'server'=>'localhost',//数据库连接地址
    'username'=>'root',//用户名
    'password'=>'',//密码
    'charset'=>'utf8',//数据库编码
    // [可选的] 数据库连接端口
    'port'=> 3306,
    // [可选]表前缀
    'prefix'=>'tp_',
    // [可选]用于连接的driver_option，阅读更多从http://www.php.net/manual/zh/pdo.setattribute.php
    'option'=> [PDO :: ATTR_CASE => PDO :: CASE_NATURAL]
]);
//------------------------ 字段别名 start------------------------------------
/*
$result = $database->debug()->select("student",
    array(
        "name(user)",//别名
        "sex"
),
    array(
        "id" => "9"
)
);
*/
//------------------------ 字段别名 end------------------------------------

//------------------------ 带条件查询 start--------------------------------
/*
$result = $database->debug()->select("student",
    array(
        "name",
        "sex"
    ),
    array(
        "id[>]" => 1
    )
);
echo "<pre>";
print_r($result);
*/
//------------------------ 带条件查询 end----------------------------------

//--------------------------- 更新 start ---------------------------------
/*
$result = $database->update("student",
    array(
//        "name" => "林书中",
        "sex[+]" => 1//字段值加 1
    ),
    array(
        "id" => 1
    )
);
echo "<pre>";
print_r($result);
*/
//---------------------------- 更新 end ----------------------------------

//--------------------------- 插入数据 insert start ----------------------
/*
$result = $database->insert("student",array(
    "name" => "林来疯",
    "age" => 26,
    "sex" => 1
));
echo "<pre>";
print_r($result);//返回的是自增的ID
*/
//--------------------------- 插入数据 insert end ------------------------

//--------------------------- 删除数据 delete start ----------------------
/*
$result = $database->delete("student",array(
    "id" => 11
));
echo "<pre>";
print_r($result);//返回删除的行数不是删除的id
*/
//--------------------------- 删除数据 delete end  -----------------------
//$database->debug()->select("student","name");


