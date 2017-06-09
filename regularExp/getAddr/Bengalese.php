<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/7
 * Time: 15:20
 */
set_time_limit(0);
//达卡市酒店 Dhaka City
//$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g293936-Dhaka_City_Dhaka_Division-Hotels.html");
//科克斯巴扎尔酒店 Cox's Bazar
//$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g667467-Cox_s_Bazar_Chittagong_Division-Hotels.html");
//吉大港市酒店 Chittagong City
//$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g319837-Chittagong_City_Chittagong_Division-Hotels.html");
//郁多罗酒店 Uttara
//$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g3350980-Uttara_Dhaka_Division-Hotels.html");
//锡尔赫特酒店 Sylhet City
//$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g667997-Sylhet_City_Sylhet_Division-Hotels.html");
//Gazipur酒店
$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g790459-Gazipur_Dhaka_Division-Hotels.html");

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
    $preg4 = "/<span class=\"extended-address\">(.*)<\/span>/isU";
//    $preg2 = "/<span property=\"v:municipality\">(.*)<\/span>/isU";
    $preg2 = "/<span property=\"v:locality\">(.*)<\/span>/isU";
    $preg3 = "/<span property=\"v:postal-code\">(.*)<\/span>/isU";
    preg_match_all($preg1,$str1,$result1);
    preg_match_all($preg2,$str1,$result2);
    preg_match_all($preg3,$str1,$result3);
    preg_match_all($preg4,$str1,$result4);
//echo "<pre>";
//print_r($result1);
//print_r($result2);
//print_r($result3);
//echo "</pre>";

    $address = $result1[1][0].'|'.$result4[1][0].','.$result2[1][0].' '.$result3[1][0];
//echo $address;
    file_put_contents("data/Bengalese.txt",$address.PHP_EOL,FILE_APPEND);
}

