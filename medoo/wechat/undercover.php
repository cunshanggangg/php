<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/28
 * Time: 11:15
 */
/*
$str = "谁是卧底13人";
$regx = "/^([\x{4e00}-\x{9fa5}]+)([\d]+)/u";
//$regx = "/^([\x{4e00}-\x{9fa5}]+)/u";

preg_match($regx,$str,$r);
echo "<pre>";
print_r($r);
echo "</pre>";
*/
require_once '../class/medoo.php';
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
$count = $database->count("undercover","*");
//echo $count;
$rand = rand(1,$count);
echo $rand;
$spy = $database->select("undercover","*",["id"=>"$rand"]);
echo "<pre>";
print_r($spy);
echo "</pre>";
$luck_number = rand(1,13);
//更新选中的状态
$database->update("undercover",["status"=>1,"luck_number"=>$luck_number],["id"=>"$rand"]);
$first = $database->select("undercover","*",["status"=>1]);
echo "<pre>";
print_r($first);
echo "</pre>";
*/
/*
//第n个获取信息的人
$fromUsername = "yaoMing";
$match[2] = 3;
$chk_res = $database->select("undercover","*",["status"=>1]);
$join_time = date("Y-m-d H:i:s");
echo "<pre>";
print_r($chk_res);
echo "</pre>";
if($chk_res) {
    $last_order_id = $database->select("player","*",["u_id"=>$chk_res[0]['id']],["order"=>"DESC","limit"=>"1"]);

    if($last_order_id[0]['order'] == ($chk_res[0]['luck_number']-1)) {
//        echo "你是卧底";
        $database->insert("player",["wxname"=>"$fromUsername","role"=>"0","role_name"=>"$chk_res[0]['spy']","u_id"=>"$chk_res[0]['id']","time"=>"$join_time","order"=>"$chk_res[0]['luck_number']"]);
        $contentStr = "http://39.108.108.194/weChat/app/undercover/show.php?keyword=".urlencode($chk_res[0]['spy'])."&time=".urlencode($join_time);
    }else if($last_order_id[0]['order'] == ($match[2]-1)){
        $order = $last_order_id[0]['order']+1;
        $database->insert("player",["wxname"=>"$fromUsername","role"=>"1","role_name"=>"$chk_res[0]['folk']","u_id"=>"$chk_res[0]['id']","time"=>"$join_time","order"=>"$order"]);
        //最后一个取完号码，更新undercover表的状态
        $database->update("undercove",["status"=>"0","luck_number"=>"0"],["id"=>"$chk_res[0]['id']"]);
        $contentStr = "http://39.108.108.194/weChat/app/undercover/show.php?keyword=".urlencode($chk_res[0]['spy'])."&time=".urlencode($join_time);
    }else{
        $order = $last_order_id[0]['order']+1;
        $database->insert("player",["wxname"=>"$fromUsername","role"=>"1","role_name"=>"$chk_res[0]['folk']","u_id"=>"$chk_res[0]['id']","time"=>"$join_time","order"=>"$order"]);
        $contentStr = "http://39.108.108.194/weChat/app/undercover/show.php?keyword=".urlencode($chk_res[0]['spy'])."&time=".urlencode($join_time);
    }
}else{
    //第一次创建的人
    //获取词组表undercover的总数
    $count = $database->count("undercover","*");
    //随机抽取一个词组的id
    $rand = rand(1,$count);
    //查询
    $spy = $database->select("undercover","*",["id"=>"$rand"]);
    //卧底号码
    $luck_number = rand(1,$match[2]);
    //更新选中的状态
    $database->update("undercover",["status"=>1,"luck_number"=>"$luck_number"],["id"=>"$rand"]);
    //插入数据到玩家player表,判断他是否为卧底,1:平民，0:卧底
    if($luck_number == 1) {
        $database->insert("player",["wxname"=>"$fromUsername","role"=>0,"role_name"=>"$spy[0]['spy']","u_id"=>"$spy[0]['id']","time"=>"$join_time","order"=>1]);
        $contentStr = "http://39.108.108.194/weChat/app/undercover/show.php?keyword=".urlencode($spy[0]['spy'])."&time=".urlencode($join_time);
    }else{
        $database->insert("player",["wxname"=>"$fromUsername","role"=>0,"role_name"=>"$spy[0]['folk']","u_id"=>"$spy[0]['id']","time"=>"$join_time","order"=>1]);
        $contentStr = "http://39.108.108.194/weChat/app/undercover/show.php?keyword=".urlencode($spy[0]['folk'])."&time=".urlencode($join_time);
    }
}
*/
/*
$join_time = date("Y-m-d h:i:s");
$count = $database->count("undercover","*");
$rand = rand(1,$count);
$spy = $database->select("undercover","*",["id"=>"$rand"]);
echo "<pre>";
print_r($spy);
echo "</pre>";
$role_name =  $spy[0]['spy'];
$u_id = $spy[0]['id'];
$match[2] = 11;
$luck_number = rand(1,$match[2]);
$database->insert("player",["wxname"=>"yaoming","role"=>0,"role_name"=>"$role_name","u_id"=>"$u_id","time"=>"$join_time","order"=>1]);
*/
//AND的用法
$wxname = "2222";
$uid = "72";
$r = $database->select("player","*",array("AND"=>array("wxname"=>"$wxname","u_id"=>"$uid")));
//echo "<pre>";
//print_r(empty($r));
//echo "</pre>";
if(empty($r)) {
  echo "为空";
}else{
    echo "不为空";
}
////$r = $database->select("player","*");
//
//echo "<pre>";
//print_r($r);
//echo "</pre>";
//order limit 的使用
//$uid = 72;
//$last_order_id = $database->select("player","*",array("u_id"=>"$uid","ORDER"=>["id"=>"DESC"],"LIMIT"=>"1"));
//echo "<pre>";
//print_r($last_order_id);
//echo "</pre>";