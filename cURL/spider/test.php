<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/3
 * Time: 17:11
 */
/*
// 初始化一个 cURL 对象
$curl = curl_init();
// 设置你需要抓取的URL
curl_setopt($curl, CURLOPT_URL, 'https://www.tripadvisor.cn');
// 设置header
curl_setopt($curl, CURLOPT_HEADER, 1);
// 设置cURL 参数，要求结果保存到字符串中还是输出到屏幕上。
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
// 运行cURL，请求网页
$data = curl_exec($curl);
echo '46456';
//echo "<pre>";
echo $data;
// 关闭URL请求
curl_close($curl);
*/

/*
$url = "http://s.jb51.net";
$ch = curl_init();
curl_setopt ($ch, CURLOPT_URL, $url);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT,10);
$dxycontent = curl_exec($ch);
echo $dxycontent;
*/


$szUrl = "https://www.tripadvisor.cn/Hotels-g298507-St_Petersburg_Northwestern_District-Hotels.html";
$UserAgent = 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; SLCC1; .NET CLR 2.0.50727; .NET CLR 3.0.04506; .NET CLR 3.5.21022; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $szUrl);
curl_setopt($curl, CURLOPT_HEADER, 1);  //0表示不输出Header，1表示输出
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_ENCODING, '');
curl_setopt($curl, CURLOPT_USERAGENT, $UserAgent);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
$data = curl_exec($curl);
//echo "<pre>";
//print_r($data);
//echo "<hr>";
$preg = '/<a target="_blank" href=\"(.*?)\".*?>(.*?)<\/a>/i';
preg_match_all($preg,$data,$result);
echo "<pre>";
print_r($result);
echo "</pre>";
//file_put_contents("data/content.txt",$data);
//echo curl_errno($curl); //返回0时表示程序执行成功 如何从curl_errno返回值获取错误信息
exit();


//function request_url($url) {
//    $ch = curl_init();
//    curl_setopt($ch, CURLOPT_URL, $url);
//    curl_setopt($ch, CURLOPT_FAILONERROR, false);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    //https 请求
//    if(strlen($url) > 5 && strtolower(substr($url,0,5)) == "https" ) {
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
//    }
//    curl_setopt($ch, CURLOPT_REFERER, $url);
//    curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
//    $reponse = curl_exec($ch);
//    return $reponse;
//}
//
//$r = request_url("https://www.tripadvisor.cn");
//echo $r;
?>