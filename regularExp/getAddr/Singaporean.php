<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/7
 * Time: 15:20
 */
set_time_limit(0);
//$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g294262-Singapore-Hotels.html");
//$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g294264-Sentosa_Island-Hotels.html");
//$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g1644875-Pulau_Ubin-Hotels.html");
//$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g294263-Jurong-Hotels.html");
//景点
//$str = file_get_contents("https://www.tripadvisor.cn/Attractions-g294262-Activities-Singapore.html");
//餐厅
$str = file_get_contents("https://www.tripadvisor.cn/Restaurants-g294262-Singapore.html");



//echo  $str;
//file_put_contents("data/Russian.txt",$str);
//$preg = '/href="(.*)"/';
//$preg = '/<a target="_blank" href="(.*?)">/';
$preg2 = '/<a target="_blank" href=\"(.*?)\".*?>(.*?)<\/a>/i';
$preg3 = '/<a href=\"(.*?)\".*? target="_blank">(.*?)<\/a>/i';
$preg = '/<a class="poiTitle" target="_blank" href=\"(.*?)\".*?>(.*?)<\/a>/i';
preg_match_all($preg,$str,$result);
//echo "<pre>";
//print_r($result);
//echo "</pre>";
foreach($result[1] as $key => $value) {
//    $url = 'https://www.tripadvisor.cn'.$result[1][0];
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
    file_put_contents("data/Singaporean.txt",$address.PHP_EOL,FILE_APPEND);
}
