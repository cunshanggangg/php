<?php
/**
 * Created by PhpStorm.
 * User: linjiabei
 * Date: 2018/4/27
 * Time: 11:52
 */
//手机版百度爬虫

$word = "我的贴身校花";
//$word = "冰帝校园行";
//$word = "下一站天后";
//$url = "http://www.m.baidu.com/s?word=".$word;
// 构造包头，模拟浏览器请求
//$header = array (
//    "Host:http://www.m.baidu.com",
//    "Content-Type:application/x-www-form-urlencoded",//post请求
//    "Connection: keep-alive",
//    'Referer:http://www.m.baidu.com',
//    'User-Agent: Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0; BIDUBrowser 2.6)'
//);
//$ch = curl_init ();
//curl_setopt ( $ch, CURLOPT_URL, $url );
//curl_setopt ( $ch, CURLOPT_HTTPHEADER, $header );
//curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
//$content = curl_exec ( $ch );
//if ($content == FALSE) {
//    echo "error:" . curl_error ( $ch );
//}
//curl_close ( $ch );
////输出结果echo $content;
//echo "<pre>";
//print_r($content);
//echo "</pre>";
//$content = curlGet($url);
//echo $content;
//file_put_contents("C:\Users\linjiabei\Desktop\str.txt",$content);
//$str = file_get_contents("C:\Users\linjiabei\Desktop\data1.txt");
//echo $str;
//$keyword = '疯狂军火王';
/*$reg = '/<div class="result c-container " id="1"[\s\S]*?><em>'."$word".'<\/em>/';*/
//preg_match_all($reg,$content,$match);
//echo "<pre>";
//print_r($match);
//echo "</pre>";
$str = file_get_contents("https://m.baidu.com/s?word=我的贴身校花");
echo "<pre>";
print_r($str);
echo "</pre>";
function curlGet($url, $isFarmat = false) {
    $ch = curl_init($url) ;
    $output = "";
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Accept' => '*/*',
        'Accept-Charset' => 'UTF-8,*;q=0.5',
        'Accept-Encoding' => 'gzip,deflate,sdch',
        'Accept-Language' => 'zh-CN,zh;q=0.8',
        'Connection' => 'keep-alive',
        'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8',
        //'Referer' => 'http://fuzhou.8684.cn/',
        'User-Agent' => 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11',
        'X-Requested-With' => 'XMLHttpRequest',
    ));

    $output = curl_exec($ch) ;

    curl_close($ch) ; //关闭链接

    if($isFarmat && $output) {
        $output = json_decode($output, true);
    }

    return $output;
}



