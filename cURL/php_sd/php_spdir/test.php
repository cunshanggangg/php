<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/21
 * Time: 16:16
 */
$ch = curl_init();//初始化，创建句柄
curl_setopt($ch, CURLOPT_URL, "https://item.taobao.com/item.htm?spm=a217m.8228632.532066.1.B3Mnlx&id=538277353007");//设置细节参数
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
$str = curl_exec($ch);//获取内容
$str = mb_convert_encoding($str,'UTF-8','GBK');//转换编码
$str = str_replace('jsonp_reviews_list(','',$str);//去掉多余的字符串
$str = str_replace(')','',$str);
$data = json_decode($str,TRUE);//得到数据了，第二个参数是转化为数组
print_r($data);//输出页面查看