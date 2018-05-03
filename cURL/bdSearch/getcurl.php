<?php
/**
 * Created by PhpStorm.
 * User: linjiabei
 * Date: 2018/5/2
 * Time: 16:42
 */
//$url = "https://m.baidu.com/s?word=我的贴身校花";
//$szUrl = "https://m.baidu.com/s?word=我的贴身校花";
//巨炮肥王轰天下，冰帝校园行，天策神方,天鳞变,古武战帝,凤凰错：替嫁弃妃 梨花笑:小小王妃倾天下 倾城笑：冷宫弃妃
$word = "倾城笑：冷宫弃妃";
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
//exit;
//判断书名是否带有冒号：
if(strpos($word,"：")) {
    $str1 = explode("：",$word);
    $reg = '/<div class="c-result result" srcid="nvl_flow" new_srcid="[\s\S]*?" order="1" tpl="nvl_flow" [\s\S]*?<div class="c-result-content">[\s\S]*?'.'<em>'.$str1[0].'<\/em>'.'：'.'<em>'.$str1[1].'<\/em>'.'[\s\S]*?<span class="c-gap-right" data-a-339f6d90 data-a-4498becf>(3G书城)<\/span>/';
}else{
    $reg = '/<div class="c-result result" srcid="nvl_flow" new_srcid="[\s\S]*?" order="1" tpl="nvl_flow" [\s\S]*?<div class="c-result-content">[\s\S]*?<em>'.$word.'<\/em>[\s\S]*?<span class="c-gap-right" data-a-339f6d90 data-a-4498becf>(3G书城)<\/span>/';
}
//读取数据
//$str = file_get_contents("C:\Users\linjiabei\Desktop\str.txt");
//$reg = '/<div class="c-result-content">[\s\S]*?<em>'.$word.'<\/em>[\s\S]*?(3G书城)/';
//$reg = '/<div class="c-result-content">[\s\S]*?<em>'.$word.'<\/em>[\s\S]*?<span class="c-gap-right" data-a-339f6d90 data-a-4498becf>(3G书城)<\/span>/';
//$reg = '/<div class="c-result result" srcid="nvl_flow" new_srcid="[\s\S]*?" order="1" tpl="nvl_flow" [\s\S]*?<div class="c-result-content">[\s\S]*?<em>'.$word.'<\/em>[\s\S]*?<span class="c-gap-right" data-a-339f6d90 data-a-4498becf>(3G书城)<\/span>/';
//$reg = '/<div class="c-result result" srcid="nvl_flow" new_srcid="[\s\S]*?" order="1" tpl="nvl_flow" [\s\S]*?<div class="c-result-content">[\s\S]*?'.'<em>梨花笑<\/em>'.'：'.'<em>小小王妃倾天下<\/em>'.'[\s\S]*?<span class="c-gap-right" data-a-339f6d90 data-a-4498becf>(3G书城)<\/span>/';

preg_match_all($reg,$data,$match);
echo "<pre>";
print_r($match);
echo "</pre>";
