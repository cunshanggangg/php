<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/18
 * Time: 16:11
 */

//$str = file_get_contents('http://www.sd020.com/shop/item-105231.html');
//$str = file_get_contents('http://www.sd020.com/shop/item-100279.html');
//$str = file_get_contents('http://www.sd020.com/shop/item-105374.html');
//echo $str;
//preg_match_all("<img alt=\"image\" src=\"(.*?)\">",$str,$result);
//preg_match_all("<img src=\"(.*?)\" class=\"img-ks-lazyload\" alt=\"image\">",$str,$result);
//echo "<pre>";
//print_r($result);
//$r = explode('/',$result[1][0]);
//echo "<pre>";
//print_r(end($r));


$str1 = file_get_contents('http://www.sd020.com/shop/index.php?act=search&op=index&keyword=&is_collect=1');
preg_match_all("<a href=\"(.*?)\" target=\"_blank\" title=\"(.*?)\">",$str1,$result1);
//echo "<pre>";
//print_r($result1);
//echo "<pre>";
//print_r(array_values(array_unique($result1[1])));
//echo "</pre>";


$fileName = array_values(array_unique($result1[1]));
$arr = [];
foreach($fileName as $k => $v) {
    $arr[] = substr($v,-11,6);
}

//echo "<pre>";
//print_r($arr);

foreach($fileName as $k1 => $v1) {
    $str = file_get_contents($v1);
//    preg_match_all("<img src=\"(.*?)\" alt=\"image\">",$str,$result);
//    preg_match_all("<img src=\"(.*?)\" class=\"img-ks-lazyload\" alt=\"image\">",$str,$result);
//    preg_match_all("<img alt=\"image\" src=\"(.*?)\">",$str,$result);
//    preg_match_all("<img class=\"blogimg\" src=\"(.*?)\" alt=\"image\">",$str,$result);
     preg_match_all("<img src=\"(.*?)\" class=\"img-ks-lazyload\" alt=\"image\">",$str,$result);


    foreach($result[1] as $k2 => $v2) {
        $r = explode('/',$v2);
        $file = end($r);
        if(!file_exists($arr[$k1])) {
            mkdir($arr[$k1],0777,true);
        }
        download_img($v2,$arr[$k1],$file);
    }
}

function download_img($url = "", $dir = "", $filename = "")
{
    $ch = curl_init(); //初始化一个curl句柄
    $hd = fopen($dir.'/'.$filename,'wb'); //只写打开或新建一个二进制文件；只允许写数据
    curl_setopt($ch,CURLOPT_URL,$url); //需要获取的 URL 地址
    curl_setopt($ch,CURLOPT_FILE,$hd); //设置成资源流的形式
    curl_setopt($ch,CURLOPT_HEADER,0); //启用时会将头文件的信息作为数据流输出。
    //curl_setopt($ch,CURLOPT_RETURNTRANSFER,false);//以数据流的方式返回数据,false时直接显示
    curl_setopt($ch,CURLOPT_TIMEOUT,60); //设置超时时间
    curl_exec($ch); //执行curl
    $curlinfo = curl_getinfo($ch);
//    echo "string";
    echo "<pre>";
    print_r($curlinfo);
    curl_close($ch); //关闭curl会话
    fclose($hd); //关闭句柄
    return true;
}

