<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/25
 * Time: 15:40
 */
require_once 'class/medoo.php';
//$str = file_get_contents("http://www.fakeaddressgenerator.com/World_more/china_address_generator");
$str = file_get_contents("data/china.txt");
//echo $str;
//$preg = "/value='(.*?)'/";//可以使用
//$preg = "|value='(.*)'|isU";//可以使用
//$preg = "<input type=\"text\" class='no-style' value='(.*?)'>";
//$preg = "<input type=\"text\" class=\"no-style\" style=\"width:100%;\" value=\"(.*?)\">";
$preg = "((<input type=\"text\" class='no-style' value='(.*?)'/>)|(<input type=\"text\" class='no-style' style='width:100%;' value='(.*?)'/>))";
//$preg = "<input type=\"text\" class='no-style' style='width:100%;' value='(.*?)'/>";
preg_match_all($preg,$str,$match);
//echo "<pre>";
//print_r($match);
//echo "</pre>";
//echo "<pre>";
//print_r(strip_tags($match[0][0]));
//echo "</pre>";

//将需要的字符组成一个新的数组
$r = array();
$r = $match[2];
$r[6] = $match[4][6];
$r[7] = $match[4][7];
$r[8] = $match[4][8];
$r[10] = $match[4][10];
//echo "<pre>";
//print_r($r);
//echo "</pre>";
//去掉空格&nbsp;
//echo str_replace("&nbsp;","",$r[0]);
//echo $r[0];
foreach ($r as $k=>$v) {
    $r[$k] = trim(str_replace("&nbsp;","",$r[$k]));
//    if($k==8 ||$k=10) {
//        $preg =;
//    }
}
//echo "<pre>";
//print_r($r);
//echo "</pre>";
//echo $r[8];

//--------------------- 获取英文地址start ---------------------------------
//$preg1 = "/[\x{4e00}-\x{9fa5}]{1,}/u";
//$preg1 = "/[^\x{4e00}-\x{9fa5}]+/u";//^取反：除去中文以外的任何字符，^[]以什么开头，$：结束。
//成都市-青羊区(Trans:ChengDu - QingYang District)
//将以上字符去除中文和()
$preg1 = "/Trans:(.*)\)$/";
//preg_match_all($preg1,str_replace('-','',$r[8]),$m);
preg_match_all($preg1,$r[8],$m);

//echo "<pre>";
//print_r($m);
//echo "</pre>";
//英文分割字符
$res = explode('-',$m[1][0]);
$res[0] = $res[0].' City';//加上市
//echo "<pre>";
//print_r($res);
//echo "</pre>";
//获取省份的拼音
preg_match_all($preg1,$r[10],$m3);
//echo "<pre>";
//print_r($m3);
//echo "</pre>";
$m3[1][0] = $m3[1][0].' Province';
//echo $m3[1][0];
//组装成英文地址
$en_address = $r[7].','.$res[1].','.$res[0].','.$m3[1][0];
//echo $en_address;
//--------------------- 获取英文地址end ----------------------------------

//---------------------- 获取中文地址start --------------------------------
$preg2 = "/[\x{4e00}-\x{9fa5}]{1,}/u";
preg_match_all($preg2,$r[8],$m2);
//echo "<pre>";
//print_r($m2);
//echo "</pre>";
//获取省份的中文名称
preg_match_all($preg2,$r[10],$m4);
//echo "<pre>";
//print_r($m4);
//echo "</pre>";
//组装中文地址
$cn_address = $m4[0][0].$m2[0][0].$m2[0][1].$r[6];
//echo $cn_address;
//--------------------- 获取中文地址end  ----------------------------------
//重新组装地址
$address = array();
$address['name'] = $r[0];
$address['gender'] = $r[3];
$address['id_card'] = $r[5];
$address['post_code'] = $r[9];
$address['phone'] = $r[11];
$address['cn_address'] = $en_address;
$address['en_address'] = $cn_address;
echo "<pre>";
print_r($address);
echo "</pre>";

$db = new medoo([
    //必需
    'database_type'=>'mysql',
    'database_name'=>'tp',      //数据库名称
    'server'=>'localhost',       //数据库连接地址
    'username'=>'root',  //用户名
    'password'=>'',  //密码
    'charset'=>'utf8',            //数据库编码
    // [可选的] 数据库连接端口
    'port'=> 3306, //
    // [可选]表前缀
//    'prefix'=>'tb_',
    // [可选]用于连接的driver_option，阅读更多从http://www.php.net/manual/zh/pdo.setattribute.php
    'option'=> [PDO :: ATTR_CASE => PDO :: CASE_NATURAL]
]);
$db->insert("tp_address",$address);
