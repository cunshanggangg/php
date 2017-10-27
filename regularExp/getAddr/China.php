<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/27
 * Time: 10:31
 */
require_once 'class/medoo.php';
error_reporting(0);
$szUrl = "http://www.fakeaddressgenerator.com/World_more/china_address_generator";
$UserAgent = 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; SLCC1; .NET CLR 2.0.50727; .NET CLR 3.0.04506; .NET CLR 3.5.21022; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
$header = forgeHeader();
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $szUrl);
curl_setopt($curl, CURLOPT_HEADER, 1);  //0表示不输出Header，1表示输出
curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
curl_setopt($curl, CURLOPT_COOKIEJAR, 'data/cookie.txt'); //连接结束后保存cookie信息的文件。
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_ENCODING, '');
curl_setopt($curl, CURLOPT_USERAGENT, $UserAgent);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
$data = curl_exec($curl);
//echo "<pre>";
//print_r($data);
//echo "</pre>";exit;
/*
$preg = "/value='(.*?)'/";//可以使用
preg_match_all($preg,$data,$result);
echo "<pre>";
print_r($result);
//print_r($result1);
echo "</pre>";exit;
$address = strip_tags(str_replace("&nbsp;","",$result[1][0])).' '.$result[1][8];
echo $address;
file_put_contents("data/american1.txt",$address.PHP_EOL,FILE_APPEND);
*/

$preg = "((<input type=\"text\" class='no-style' value='(.*?)'/>)|(<input type=\"text\" class='no-style' style='width:100%;' value='(.*?)'/>))";
//$preg = "<input type=\"text\" class='no-style' style='width:100%;' value='(.*?)'/>";
preg_match_all($preg,$data,$match);
//echo "<pre>";
//print_r($match);
//echo "</pre>";
//echo "<pre>";
//print_r(strip_tags($match[0][0]));
//echo "</pre>";

//将需要的字符组成一个新的数组
//echo "<pre>";
//print_r($match[2]);
//echo "</pre>";
//echo "<hr>";
$r = array();
$r = $match[2];
$r[7] = $match[4][7];
$r[8] = $match[4][8];
$r[9] = $match[4][9];
$r[11] = $match[4][11];
//echo "<pre>";
//print_r($r);
//echo "</pre>";
//echo "<hr>";
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
preg_match_all($preg1,$r[9],$m);

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
preg_match_all($preg1,$r[11],$m3);
//echo "<pre>";
//print_r($m3);
//echo "</pre>";
$m3[1][0] = $m3[1][0].' Province';
//echo $m3[1][0];
//组装成英文地址
$en_address = $r[8].','.$res[1].','.$res[0].','.$m3[1][0];
//echo $en_address;
//--------------------- 获取英文地址end ----------------------------------

//---------------------- 获取中文地址start --------------------------------
$preg2 = "/[\x{4e00}-\x{9fa5}]{1,}/u";
preg_match_all($preg2,$r[9],$m2);
//echo "<pre>";
//print_r($m2);
//echo "</pre>";
//获取省份的中文名称
preg_match_all($preg2,$r[11],$m4);
//echo "<pre>";
//print_r($m4);
//echo "</pre>";
//组装中文地址
$cn_address = $m4[0][0].$m2[0][0].$m2[0][1].$r[7];
//echo $cn_address;
//--------------------- 获取中文地址end  ----------------------------------
//重新组装地址
$address = array();
$address['name'] = $r[0];
$address['gender'] = $r[3];
$address['birthday'] = $r[5];
$address['id_card'] = $r[6];
$address['post_code'] = $r[10];
$address['phone'] = $r[12];
$address['cn_address'] = $cn_address;
$address['en_address'] = $en_address;
//echo "<pre>";
//print_r($address);
//echo "</pre>";//exit;
//echo $cn_address;
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
if(!empty($address['name']) && !empty($address['gender']) && !empty($address['birthday']) && !empty($address['id_card']) && !empty($address['post_code']) && !empty($address['phone']) && !empty($address['cn_address']) && !empty($address['en_address'])) {
    echo "<pre>";
    print_r($address);
    echo "</pre>";
    $db->insert("tp_address",$address);
}
echo "<script>window.location.reload();</script>";

//伪造请求头
function forgeHeader() {
    $cip = '123.125.68.'.mt_rand(0,254);
    $xip = '125.90.88.'.mt_rand(0,254);
    $result = array(
        'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
        'Accept-Encoding:gzip,deflate,sdch',
        'Accept-Language:zh-CN,zh;q=0.8',
        'CLIENT-IP:'.$cip,
        'X-FORWARDED-FOR:'.$xip,
        //'Accept-Charset:GBK;q=0.7,*;q=0.3',
        //'Connection:keep-alive',
        'Content-Type:application/x-www-form-urlencoded;charset=UTF-8',
        //模拟浏览器
        'user-agent:Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2618.8 Safari/537.36'
        //'CLIENT-IP:'.$ip,
        //'X-FORWARDED-FOR:'.$ip,
    );
    return $result;
}