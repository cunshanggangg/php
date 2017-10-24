<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/24
 * Time: 13:58
 */
$str = <<<xml
<?xml version="1.0" encoding="UTF-8"?>
<person>
    <name><![CDATA[toUser]]>村上岗</name>
    <gender>男</gender>
    <age>24</age>
    <address>中国 北京市</address>
</person>
xml;
//第三个参数 是预定于常量，LIBXML_NOCDATA表示：Merge CDATA as text nodes（合并CDATA文本节点）
$xmlObj = simplexml_load_string($str,"SimpleXMLElement",LIBXML_NOCDATA);
echo "<pre>";
var_dump($xmlObj);
echo "</pre>";
