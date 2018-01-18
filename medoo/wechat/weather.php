<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/17
 * Time: 14:51
 */
function cUrl() {
    $chjk = curl_init('http://404.php.net/');//初始化一个curl会话
    $url = 'http://www.sojson.com/open/api/weather/json.shtml?city=白云区';
    curl_setopt($chjk,CURLOPT_URL, $url);//设置curl会话的接口地址
    curl_setopt($chjk,CURLOPT_CUSTOMREQUEST,"GET");//设置请求方式为GET
    curl_setopt($chjk,CURLOPT_RETURNTRANSFER,1);//设置CURLOPT_RETURNTRANSFER为1，表示如果成功只将结果返回，不自动输出任何内容。如果失败返回FALSE
    curl_setopt($chjk, CURLOPT_HEADER, 0);
    $res = curl_exec($chjk);
//    echo "<pre>";
//    print_r(json_decode($res));
//    echo "</pre>";exit;
    return json_decode($res,true);
}
$r = cUrl();
echo "<pre>";
print_r($r);
echo "</pre>";
echo "昨天:\n";
$str = $r['data']['yesterday']['date']."\n".'日出:'.$r['data']['yesterday']['sunrise']."\n".'最高温:'.$r['data']['yesterday']['high']."\n".'最低温:'.$r['data']['yesterday']['low']."\n".'日落:'.$r['data']['yesterday']['sunset']."\n".'空气质量:'.$r['data']['yesterday']['aqi']."\n".'风向:'.$r['data']['yesterday']['fx']."\n".'风级:'.$r['data']['yesterday']['fl']."\n".'类型:'.$r['data']['yesterday']['type']."\n".'温馨提示:'.$r['data']['yesterday']['notice']."\n\r";
foreach($r['data']['forecast'] as $k=>$v) {
    $str .= $v['date']."\n".'日出:'.$v['sunrise']."\n".'最高温:'.$v['high']."\n".'最低温:'.$v['low']."\n".'日落:'.$v['sunset']."\n".'空气质量:'.$v['aqi']."\n".'风向:'.$v['fx']."\n".'风级:'.$v['fl']."\n".'类型:'.$v['type']."\n".'温馨提示:'.$v['notice']."\n\r";
}
echo $str;


