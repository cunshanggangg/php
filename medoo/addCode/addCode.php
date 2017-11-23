<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/23
 * Time: 10:42
 */
require_once '../class/medoo.php';
date_default_timezone_set('PRC');
$db = new medoo([
    //必需
    'database_type'=>'mysql',
    'database_name'=>'jdpt1',      //数据库名称
    'server'=>'192.168.17.39',       //数据库连接地址
    'username'=>'root',  //用户名
    'password'=>'123456',  //密码
    'charset'=>'utf8',            //数据库编码
    // [可选的] 数据库连接端口
    'port'=> 3306, //3629
    // [可选]表前缀
//    'prefix'=>'tb_',
    // [可选]用于连接的driver_option，阅读更多从http://www.php.net/manual/zh/pdo.setattribute.php
    'option'=> [PDO :: ATTR_CASE => PDO :: CASE_NATURAL]
]);
//echo "<pre>";
//print_r($db);
//echo "</pre>";
$r = $db->select("shopnc_ypl_member","*",["addr_code"=>null]);
//echo "<pre>";
//print_r($r);
//echo "</pre>";
$preg = "/(.*?(省|区|市))|(.*?(市))|(.*?(区|县|市))/";
//echo $r[3]['addr'];
//$r[3]['addr']  = "湖北省宜昌市珍珠路80号";
//echo $r[2]['addr'];
//preg_match_all($preg,$r[3]['addr'],$match);
//echo "<pre>";
//print_r($match);
//echo "</pre>";
foreach($r as $k=>$v) {
    preg_match_all($preg,$v['addr'],$match);
//    echo "<pre>";
//    print_r($match);
//    echo "</pre>";
//    echo "<hr>";
//    echo $match[0][0];
//    echo $match[0][1];
//    echo $match[0][2];
    $r[$k]['province'] = $match[0][0];
    $r[$k]['city'] = $match[0][1];
    if(!empty($match[0][2])) {
        $r[$k]['area'] = $match[0][2];
    }else{
        $r[$k]['area'] = "";
    }

}
//重新组装数组
//echo "<pre>";
//print_r($r);
//echo "</pre>";
//exit;
$db1 = new medoo([
    //必需
    'database_type'=>'mysql',
    'database_name'=>'o2oclms',      //数据库名称
    'server'=>'192.168.17.39',       //数据库连接地址
    'username'=>'root',  //用户名
    'password'=>'123456',  //密码
    'charset'=>'utf8',            //数据库编码
    // [可选的] 数据库连接端口
    'port'=> 3306, //3629
    // [可选]表前缀
//    'prefix'=>'tb_',
    // [可选]用于连接的driver_option，阅读更多从http://www.php.net/manual/zh/pdo.setattribute.php
    'option'=> [PDO :: ATTR_CASE => PDO :: CASE_NATURAL]
]);
//echo "<pre>";
//print_r($r);
//echo "</pre>";exit;
//$result = $db1->select("t_base_citycode","citycode",["cityname"=>$r[0]['province']]);
//echo "<pre>";
//print_r($result);
//echo "</pre>";
//exit;
foreach ($r as $k=>$v) {
    $province = $db1->select("t_base_citycode","citycode",["cityname"=>$v['province']]);
//    echo $province;
    $city = $db1->select("t_base_citycode","citycode",["cityname"=>$v['city']]);
//    echo $city;
    $area = $db1->select("t_base_citycode","citycode",["cityname"=>$v['area']]);
//    echo $area;
    if($area) {
        $r[$k]['addr_code'] = $province[0]."|".$city[0]."|".$area[0];
    }else{
        $r[$k]['addr_code'] = $province[0]."|".$city[0];
    }
}
echo "<pre>";
print_r($r);
echo "</pre>";
