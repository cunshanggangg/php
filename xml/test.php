<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/24
 * Time: 10:47
 */
$xmlStr = <<<xml
<?xml version="1.0" encoding="UTF-8"?>
<people>
    <name>村上岗</name>
    <gender>男</gender>
    <age>24</age>
    <address>中国 北京</address>
</people>
xml;
//将XML数据转换成对象
$xml = simplexml_load_string($xmlStr);
//echo "<pre>";
//print_r($xml);
//echo "</pre>";
//直接访问数据
//echo $xml->name;//村上岗
//直接转换成数组
$r = (array)$xml;
echo "<pre>";
print_r($r);
echo "</pre>";
//字符串直接转成数组
$s = 'yaoMing';
$r = (array) $s;
echo "<pre>";
print_r($r);
echo "</pre>";
