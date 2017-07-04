<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/4
 * Time: 9:39
 */
$szUrl = "http://haoweichi.com/Others/ri_ben_ren_shen_fen_zi_liao";
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
$preg = "<input type=\"text\" value='(.*)' class='color5'/>";
$preg1 = "<input type=\"text\" value='(.*)' class='color2'/>";
preg_match_all($preg,$data,$result);
preg_match_all($preg1,$data,$result1);
//echo "<pre>";
//print_r($result);
//print_r($result1);
//echo "</pre>";
$address = $result[1][0].' '.$result1[1][4];
echo $address;
file_put_contents("data/Japanese.txt",$address.PHP_EOL,FILE_APPEND);
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