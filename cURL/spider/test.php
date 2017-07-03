<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/3
 * Time: 17:11
 */
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