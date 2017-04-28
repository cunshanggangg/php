<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/28
 * Time: 14:55
 */
header("content-type:text/html;charset=utf-8");
try {
    $client = new SoapClient("http://14.23.90.100/webservice/services/UmpsTradeService?wsdl");
    echo "<pre>";
    //print_r($client->__getFunctions());
    echo "</pre>";
    echo "<hr>";
    echo "<pre>";
    //print_r($client->__getTypes());
    echo "</pre>";
} catch (SOAPFault $e) {
    print $e;
}
//拼接XML数据
$xml='<?xml version="1.0" encoding="UTF-8"?><info>';
$xml.='<name>yaoMing</name>';
$xml.='<sex>male</sex>';
$xml.='<position>center</position>';
$xml.='<birth>1982-09-12</birth>';
$xml.='<country>China</country>';
$xml.='</info>';

//echo "<pre>";
//print_r($xml);
//echo "</pre>";
//echo $xml;

//xml转变为json数据格式
//echo json_encode(simplexml_load_string($xml));

//json格式转变成数组
echo "<pre>";
print_r(json_decode(json_encode(simplexml_load_string($xml)),true));
echo "</pre>";
