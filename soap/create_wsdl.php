<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/17
 * Time: 14:51
 */
include 'Service.php';
include 'class/SoapDiscovery.class.php';
$disc = new SoapDiscovery('Service','soap');
$disc->getWSDL();
//echo $strXML;