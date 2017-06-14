<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/7
 * Time: 15:20
 */
set_time_limit(0);
//$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g298570-Kuala_Lumpur_Wilayah_Persekutuan-Hotels.html");
//$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g660694-Penang_Island_Penang-Hotels.html");
//$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g306997-Melaka_Central_Melaka_District_Melaka_State-Hotels.html");
//$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g298283-Langkawi_Langkawi_District_Kedah-Hotels.html");
//$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g298303-George_Town_Penang_Island_Penang-Hotels.html");
//$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g298307-Kota_Kinabalu_Kota_Kinabalu_District_West_Coast_Division_Sabah-Hotels.html");
//$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g298278-Johor_Bahru_Johor_Bahru_District_Johor-Hotels.html");
//$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g298309-Kuching_Sarawak-Hotels.html");
//$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g298298-Ipoh_Kinta_District_Perak-Hotels.html");
//$str = file_get_contents("https://www.tripadvisor.cn/Hotels-g298285-Kota_Bharu_Kelantan-Hotels.html");
$str = file_get_contents("https://www.tripadvisor.cn/Hotel_Review-g298570-d1953069-Reviews-Villa_Samadhi-Kuala_Lumpur_Wilayah_Persekutuan.html");




//echo  $str;
//file_put_contents("data/Russian.txt",$str);
//$preg = '/href="(.*)"/';
//$preg = '/<a target="_blank" href="(.*?)">/';
$preg = '/<a target="_blank" href=\"(.*?)\".*?>(.*?)<\/a>/i';
preg_match_all($preg,$str,$result);
//echo "<pre>";
//print_r($result);
//echo "</pre>";
//foreach($result[1] as $key => $value) {
//    $url = 'https://www.tripadvisor.cn'.$result[1][$key];
    $url = 'https://www.tripadvisor.cn'.$value;
    $str1 = file_get_contents($url);
//echo "<pre>";
//print_r($str1);
//echo "</pre>";
//    $preg1 = "/<span class=\"street-address\">(.*)<\/span>/isU";
//    $preg2 = "/<span property=\"v:municipality\">(.*)<\/span>/isU";
//    $preg2 = "/<span property=\"v:locality\">(.*)<\/span>/isU";
//    $preg3 = "/<span property=\"v:postal-code\">(.*)<\/span>/isU";
//    preg_match_all($preg1,$str1,$result1);
//    preg_match_all($preg2,$str1,$result2);
//    preg_match_all($preg3,$str1,$result3);
    $preg4 = "/<span>(.*)<\/span>/isU";
    preg_match_all($preg4,$str1,$result4);
echo "<pre>";
//print_r($result1);
//print_r($result2);
//print_r($result3);
print_r($result4);
echo "</pre>";

//    $address = $result1[1][0].','.$result2[1][0].' '.$result3[1][0];
//echo $address;
//    file_put_contents("data/Malaysian.txt",$address.PHP_EOL,FILE_APPEND);
//}
//function escramble_100(){
//$a='00 6';
//$b='143 ';
//$a+='0 3-';
//$b+='2300';
//$c='2';
//echo ($a+$c+$b);
//}
//escramble_100();
