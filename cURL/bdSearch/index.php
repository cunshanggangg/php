<?php
/**
 * Created by PhpStorm.
 * User: linjiabei
 * Date: 2018/4/27
 * Time: 11:52
 */
//$word = "我的贴身校花";
//$word = "冰帝校园行";
//$word = "下一站天后";
$url = "http://www.baidu.com/s?wd=".$word;
// 构造包头，模拟浏览器请求
$header = array (
    "Host:www.baidu.com",
    "Content-Type:application/x-www-form-urlencoded",//post请求
    "Connection: keep-alive",
    'Referer:http://www.baidu.com',
    'User-Agent: Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0; BIDUBrowser 2.6)'
);
$ch = curl_init ();
curl_setopt ( $ch, CURLOPT_URL, $url );
curl_setopt ( $ch, CURLOPT_HTTPHEADER, $header );
curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
$content = curl_exec ( $ch );
if ($content == FALSE) {
    echo "error:" . curl_error ( $ch );
}
curl_close ( $ch );
//输出结果echo $content;
//echo "<pre>";
//print_r($content);
//echo "</pre>";
//file_put_contents("C:\Users\linjiabei\Desktop\data1.txt",$content);
//$str = file_get_contents("C:\Users\linjiabei\Desktop\data1.txt");
//echo $str;
//$keyword = '疯狂军火王';
$reg = '/<div class="result c-container " id="1"[\s\S]*?><em>'."$word".'<\/em>/';
preg_match_all($reg,$content,$match);
echo "<pre>";
print_r($match);
echo "</pre>";

