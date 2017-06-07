<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/7
 * Time: 15:20
 */
//$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g298507-St_Petersburg_Northwestern_District-Hotels.html");
//$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g298536-Sochi_Greater_Sochi_Krasnodar_Krai_Southern_District-Hotels.html");
//$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g298520-Kazan_Republic_of_Tatarstan_Volga_District-Hotels.html");
//$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g298537-Volgograd_Volgograd_Oblast_Southern_District-Hotels.html");
//$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g298484-Moscow_Central_Russia-Hotels.html");
//$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g298529-Novosibirsk_Novosibirsky_District_Novosibirsk_Oblast_Siberian_District-Hotels.html");
//$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g298532-Krasnodar_Krasnodar_Krai_Southern_District-Hotels.html");
//$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g2619350-Vityazevo_Anapsky_District_Krasnodar_Krai_Southern_District-Hotels.html");
$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g298496-Vladivostok_Primorsky_Krai_Far_Eastern_District-Hotels.html");
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
    $url = 'https://www.tripadvisor.cn'.$result[1][$key];
    $str1 = file_get_contents($url);
//echo "<pre>";
//print_r($str1);
//echo "</pre>";
    $preg1 = "/<span class=\"street-address\">(.*)<\/span>/isU";
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
    file_put_contents("data/Russian.txt",$address.PHP_EOL,FILE_APPEND);
}
