<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/7
 * Time: 15:20
 */
set_time_limit(0);
//新德里
//$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g304551-New_Delhi_National_Capital_Territory_of_Delhi-Hotels.html");
//班加罗尔
//$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g297628-Bengaluru_Bangalore_District_Karnataka-Hotels.html");
//金奈（马德拉斯）酒店
//$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g304556-Chennai_Madras_Chennai_District_Tamil_Nadu-Hotels.html");
//孟买酒店
//$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g304554-Mumbai_Bombay_Maharashtra-Hotels.html");
//斋蒲尔酒店
//$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g304555-Jaipur_Jaipur_District_Rajasthan-Hotels.html");
//海德拉巴酒店
//$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g297586-Hyderabad_Hyderabad_District_Telangana-Hotels.html");
//古尔冈酒店
$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g297615-Gurugram_Gurgaon_Gurgaon_District_Haryana-Hotels.html");




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
    file_put_contents("data/Indian.txt",$address.PHP_EOL,FILE_APPEND);
}
