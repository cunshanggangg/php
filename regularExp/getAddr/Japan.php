<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/30
 * Time: 11:05
 */
require_once 'class/medoo.php';
error_reporting(0);
$szUrl = "http://www.fakeaddressgenerator.com/World_more/Japan_address_generator";
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

//$preg = "((<input type=\"text\" class='no-style' value='(.*?)'/>)|(<input type=\"text\" class='no-style' style='width:100%;' value='(.*?)'/>))";
//$preg = "<input type=\"text\" class='no-style' style='width:100%;' value='(.*?)'/>";
$preg = "|value='(.*)'|isU";//可以使用
preg_match_all($preg,$data,$match);
//echo "<pre>";
//print_r($match);
//echo "</pre>";exit;



//重新组装地址
$address = array();
//$address['name'] = str_replace("&nbsp;"," ",$match[1][0]);
$address['name'] = $match[1][1].' '.$match[1][2];
$address['gender'] = $match[1][4];
$address['birthday'] = $match[1][5];
$address['phone'] = $match[1][10];
$address['post_code'] = $match[1][9];
$address['address'] = $match[1][8];
//echo "<pre>";
//print_r($address);
//echo "</pre>";exit;
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
//if(!empty($address['name']) && !empty($address['gender']) && !empty($address['birthday']) && !empty($address['post_code']) && !empty($address['phone']) && !empty($address['address'])) {
//    echo "<pre>";
//    print_r($address);
//    echo "</pre>";
//    $db->insert("tp_us_address",$address);
//}
echo "<pre>";
print_r($address);
echo "</pre>";
$n = $db->insert("tp_japan_address",$address);
if($n >= 0) {
    sleep(10);
    echo "<script>window.location.reload();</script>";
}


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