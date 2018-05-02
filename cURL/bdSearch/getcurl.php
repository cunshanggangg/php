<?php
/**
 * Created by PhpStorm.
 * User: linjiabei
 * Date: 2018/5/2
 * Time: 16:42
 */
//$url = "https://m.baidu.com/s?word=我的贴身校花";
//$szUrl = "https://m.baidu.com/s?word=我的贴身校花";
$word = "巨炮肥王轰天下";
$szUrl = "https://m.baidu.com/s?word=$word";
$UserAgent = 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; SLCC1; .NET CLR 2.0.50727; .NET CLR 3.0.04506; .NET CLR 3.5.21022; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $szUrl);
curl_setopt($curl, CURLOPT_HEADER, 0);  //0表示不输出Header，1表示输出
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_ENCODING, '');
curl_setopt($curl, CURLOPT_USERAGENT, $UserAgent);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
$data = curl_exec($curl);
//file_put_contents("C:\Users\linjiabei\Desktop\str.txt",$data);
//echo $data;

//读取数据
//$str = file_get_contents("C:\Users\linjiabei\Desktop\str.txt");
$reg = '/<div class="c-result-content">[\s\S]*?<em>'.$word.'<\/em>[\s\S]*?(3G书城)/';
preg_match_all($reg,$data,$match);
echo "<pre>";
print_r($match);
echo "</pre>";
