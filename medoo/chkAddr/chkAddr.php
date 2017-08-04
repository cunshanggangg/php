<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/27
 * Time: 15:39
 */
error_reporting(0);
require_once '../class/medoo.php';
date_default_timezone_set('PRC');
/*
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
*/
$db = new medoo([
    //必需
    'database_type'=>'mysql',
    'database_name'=>'o2oclms',      //数据库名称
    'server'=>'rdsjxo3wd4voprxkrdw15public.mysql.rds.aliyuncs.com',       //数据库连接地址
    'username'=>'wuliu',  //用户名
    'password'=>'20150929WUliu',  //密码
    'charset'=>'utf8',            //数据库编码
    // [可选的] 数据库连接端口
    'port'=> 3629, //
    // [可选]表前缀
//    'prefix'=>'tb_',
    // [可选]用于连接的driver_option，阅读更多从http://www.php.net/manual/zh/pdo.setattribute.php
    'option'=> [PDO :: ATTR_CASE => PDO :: CASE_NATURAL]
]);

//$start = date("Y-m-d 00:00:00");
//$start = date("2017-07-27 00:00:00");
//$start = date("2017-07-27");
//$end = date("2017-07-28",strtotime("+1 days"));
//echo "<pre>";
//print_r($_POST);
//print_r($_GET);
//echo $start;
//echo $end;
//echo "<br>";
//echo $start;
//$end = date("Y-m-d 00:00:00",strtotime("+1 days"));
//$end = date("2017-07-28 00:00:00",strtotime("+1 days"));
//echo $end;
#打印sql语句
//$r = $db->debug()->select("tb_order",["o_id","o_ot_id","o_rec_addr","province_code","city_code","area_code","o_wm_state"],["o_create_date[<>]"=>[$start,$end]]);

//echo "<pre>";
//echo print_r($r);
//echo "</pre>";
//查詢結果
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
//搜索省市區代碼
if($_POST['itemName'] !="") {
    $itemName = $_POST['itemName'];
    $res = $db->select("t_base_citycode",["citycode"],["cityname"=>$itemName]);
    exit(json_encode($res));
}
if(($_POST['province_code'] !="") && ($_POST['city_name']!="") && ($_POST['city_code']!="") && ($_POST['area_code']!="")) {
    $o_id = $_POST['o_id'];
    $province_code = $_POST['province_code'];
    $city_name = $_POST['city_name'];
    $city_code = $_POST['city_code'];
    $area_code = $_POST['area_code'];
//    $resSql = [];
    //更新tb_order表
    $resSql[] = "UPDATE tb_order SET province_code = '{$province_code}',city_code = '{$city_code}',area_code = '{$area_code}' WHERE o_id = '{$o_id}';";
    //更新tb_express_order表
    $resSql[] = "UPDATE tb_express_order SET el_d_province_code = '{$province_code}',el_d_city = '{$city_name}',el_d_city_code = '{$city_code}',el_d_area_code = '{$area_code}' WHERE el_order_id = '{$o_id}';";
    //更新tb_entry_log表
    $resSql[] = "UPDATE tb_entry_log SET el_rec_provinces = '{$province_code}' WHERE el_order_id = '{$o_id}';";
//    $resSql = array('pwd'=>'123456');
    $str_OrderId = '['.date('Y-m-d H:i:s').']'."\n".$o_id."\n";
    $dir = "log/".'order_id_'.date('Ymd').".txt";
    $str_Sql = '['.date('Y-m-d H:i:s').']'."\n".$resSql[0]."\n".$resSql[1]."\n".$resSql[2]."\n";
    file_put_contents("log/".'order_id_'.date('Ymd').".txt",$str_OrderId,FILE_APPEND);
    file_put_contents("log/".'sql_'.date('Ymd').".txt",$str_Sql,FILE_APPEND);
    exit(json_encode($resSql));
}
//echo "31231";
//$resSql = array('pwd'=>'123456');
//echo "<pre>";
//echo json_encode($resSql);
//echo "</pre>";
//輸出sql語句

//exit("daddd");