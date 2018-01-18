<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/18
 * Time: 9:18
 */
function cUrl($area) {
    $chjk = curl_init('http://404.php.net/');//初始化一个curl会话
    $url = "http://api.map.baidu.com/telematics/v3/weather?location=$area&output=json&ak=A97e3bda2ac739aa574f16ec94055d75";
    curl_setopt($chjk,CURLOPT_URL, $url);//设置curl会话的接口地址
    curl_setopt($chjk,CURLOPT_CUSTOMREQUEST,"GET");//设置请求方式为GET
    curl_setopt($chjk,CURLOPT_RETURNTRANSFER,1);//设置CURLOPT_RETURNTRANSFER为1，表示如果成功只将结果返回，不自动输出任何内容。如果失败返回FALSE
    curl_setopt($chjk, CURLOPT_HEADER, 0);
    $res = curl_exec($chjk);
    return json_decode($res,true);
}

$r = cUrl("白云区");
echo "<pre>";
print_r($r['results'][0]['weather_data']);
echo "</pre>";
echo count($r['results'][0]['weather_data'])+1;
echo $r['results'][0]['weather_data'][0]['date']. "\n".$r['results'][0]['weather_data'][0]['weather']." ".$r['results'][0]['weather_data'][0]['wind']." ".$r['results'][0]['weather_data'][0]['temperature'];