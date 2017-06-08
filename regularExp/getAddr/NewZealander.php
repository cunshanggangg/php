<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/7
 * Time: 15:20
 */
set_time_limit(0);
//基督城酒店 Christchurch
//$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g255118-Christchurch_Canterbury_Region_South_Island-Hotels.html");
//奥克兰中心地区酒店 Auckland
//$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g255106-Auckland_North_Island-Hotels.html");
//罗托鲁瓦酒店 Rotorua
//$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g255111-Rotorua_Rotorua_District_Bay_of_Plenty_Region_North_Island-Hotels.html");
//皇后镇公园精品酒店 Queenstown Park Boutique Hotel
$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g255122-Queenstown_Otago_Region_South_Island-Hotels.html");



//echo  $str;
//file_put_contents("data/Russian.txt",$str);
//$preg = '/href="(.*)"/';
//$preg = '/<a target="_blank" href="(.*?)">/';
$preg = '/<a target="_blank" href=\"(.*?)\".*?>(.*?)<\/a>/i';
preg_match_all($preg,$str,$result);
//echo "<pre>";
//print_r($result);
//echo "</pre>";
foreach($result[1] as $key => $value) {
//    $url = 'https://www.tripadvisor.cn'.$result[1][$key];
    $url = 'https://www.tripadvisor.cn'.$value;
    $str1 = file_get_contents($url);
//echo "<pre>";
//print_r($str1);
//echo "</pre>";
    $preg1 = "/<span class=\"street-address\" property=\"v:street-address\">(.*)<\/span>/isU";
//    $preg2 = "/<span property=\"v:municipality\">(.*)<\/span>/isU";
    $preg2 = "/<span property=\"v:locality\">(.*)<\/span>/isU";
    $preg3 = "/<span property=\"v:postal-code\">(.*)<\/span>/isU";
    preg_match_all($preg1,$str1,$result1);
    preg_match_all($preg2,$str1,$result2);
    preg_match_all($preg3,$str1,$result3);
//echo "<pre>";
//print_r($result1);
//print_r($result2);
//print_r($result3);
//echo "</pre>";

    $address = $result1[1][0].','.$result2[1][0].' '.$result3[1][0];
//echo $address;
    file_put_contents("data/NewZealander.txt",$address.PHP_EOL,FILE_APPEND);
}
