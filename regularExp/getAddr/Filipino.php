<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/7
 * Time: 15:20
 */
set_time_limit(0);
//吕宋岛酒店
//$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g294248-Luzon-Hotels.html");
//民答那峨岛酒店 Mindanao
//$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g294252-Mindanao-Hotels.html");
//班乃岛酒店 Panay Island
//$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g298465-Panay_Island_Visayas-Hotels.html");
//宿雾酒店 Cebu Island
//$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g294261-Cebu_Island_Visayas-Hotels.html");
//巴拉望岛酒店 Palawan Island
$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g294255-Palawan_Island_Palawan_Province_Mimaropa-Hotels.html");






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
    file_put_contents("data/Filipino.txt",$address.PHP_EOL,FILE_APPEND);
}
