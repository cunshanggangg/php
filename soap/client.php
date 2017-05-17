<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/17
 * Time: 14:59
 */
ini_set('soap.wsdl_cache_enabled', "0"); //关闭wsdl缓存
$soap = new SoapClient('http://localhost/php/soap/Service.php?wsdl');
echo $soap->Add(28, 2);
echo $soap->__soapCall('Add',array(28,2));//或这样调用

#echo $soap->__Call('Add',array(28,2));
//echo ($soap->HelloWorld());
//echo "<pre>";
//print_r($soap);
//var_dump ($soap->__getTypes());
//echo "</pre>";
//echo $soap->Add(28, 2);
//echo $soap->__soapCall('Add',array(28,2));//或这样调用
//echo $soap->__Call('Add',array(28,2));