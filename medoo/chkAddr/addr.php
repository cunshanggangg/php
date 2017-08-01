<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/1
 * Time: 10:00
 */
require_once '../class/medoo.php';
date_default_timezone_set('PRC');
$db = new medoo([
    //必需
    'database_type'=>'mysql',
    'database_name'=>'020',      //数据库名称
    'server'=>'localhost',       //数据库连接地址
    'username'=>'root',  //用户名
    'password'=>'',  //密码
    'charset'=>'utf8',            //数据库编码
    // [可选的] 数据库连接端口
    'port'=> 3306, //3629
    // [可选]表前缀
//    'prefix'=>'tb_',
    // [可选]用于连接的driver_option，阅读更多从http://www.php.net/manual/zh/pdo.setattribute.php
    'option'=> [PDO :: ATTR_CASE => PDO :: CASE_NATURAL]
]);

if(($_POST['start'] !="") && ($_POST['end']!="")) {
    $start = $_POST['start'];
    $end = $_POST['end'];
    //查找结果
    $r = $db->select("tb_order",
        ["o_id","o_ot_id","o_rec_addr","province_code","city_code","area_code","o_wm_state","o_create_date"],
        ["AND"=>
            ["OR"=>["province_code"=>"","city_code"=>"","area_code"=>""],
                "o_create_date[<>]"=>[$start,$end]]
        ]);
    exit(json_encode($r));
}