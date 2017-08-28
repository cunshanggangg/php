<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/28
 * Time: 10:44
 */
function randomFloat($min = 0, $max = 100) {
    $num =  $min + mt_rand() / mt_getrandmax() * ($max - $min);
    return sprintf("%.5f", $num);
}

//var_dump(randomFloat());
//echo randomFloat(20.54,26.23).','.randomFloat(104.29,112.04);
$latlng = randomFloat(20.54,26.23).','.randomFloat(104.29,112.04);

//通过随机获得的经纬度，利用谷歌地图的开放的经纬度反解析地址来获取详细地址
//http://maps.google.com/maps/api/geocode/json?latlng=26.02114,106.18600&language=zh-CN&sensor=false
//$url = "http://maps.google.com/maps/api/geocode/json?latlng=$latlng&language=zh-CN&sensor=false";
//echo "<script>";
//echo "location.href='$url'";
//echo "</script>";
//$url = "http://mil.news.sina.com.cn/china/2017-08-28/doc-ifykiuaz1355783.shtml";
//$result = file_get_contents("http://maps.google.com/maps/api/geocode/json?latlng=23.46089,110.80980&language=zh-CN&sensor=false",null,null);
//echo "<pre>";
//print_r($result);
//echo "</pre>";

$url = "http://maps.google.com/maps/api/geocode/json?latlng=23.46089,110.80980&language=zh-CN&sensor=false";
$ch = curl_init();
curl_setopt ($ch,CURLOPT_URL,$url);
curl_setopt ($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt ($ch,CURLOPT_CONNECTTIMEOUT,60);
$img = curl_exec($ch);
$err = curl_error($ch);
echo "<pre>";
print_r($img);
print_r($err);
echo "</pre>";

//$ch = curl_init();
//$timeout = 10; // set to zero for no timeout
//curl_setopt ($ch, CURLOPT_URL,'http://maps.google.com/maps/api/geocode/json?latlng=$latlng&language=zh-CN&sensor=false');
//curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
//$url = curl_exec($ch);
//echo "<pre>";
//print_r($url);
//echo "</pre>";

//$szUrl = "http://maps.google.com/maps/api/geocode/json?latlng=$latlng&language=zh-CN&sensor=false";
//$UserAgent = 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; SLCC1; .NET CLR 2.0.50727; .NET CLR 3.0.04506; .NET CLR 3.5.21022; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
//$curl = curl_init();
//curl_setopt($curl, CURLOPT_URL, $szUrl);
//curl_setopt($curl, CURLOPT_HEADER, 1);  //0表示不输出Header，1表示输出
//curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
//curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
//curl_setopt($curl, CURLOPT_ENCODING, '');
//curl_setopt($curl, CURLOPT_USERAGENT, $UserAgent);
//curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
//$data = curl_exec($curl);
////echo "4654646";
//echo "<pre>";
//print_r($data);
//echo "</pre>";
//

//$url = "http://maps.google.com/maps/api/geocode/json?latlng=$latlng&language=zh-CN&sensor=false";
//$ch = curl_init();
//$timeout = 5;
//curl_setopt($ch, CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
////在需要用户检测的网页里需要增加下面两行
////curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
////curl_setopt($ch, CURLOPT_USERPWD, US_NAME.":".US_PWD);
//$contents = curl_exec($ch);
//curl_close($ch);
//echo $contents;