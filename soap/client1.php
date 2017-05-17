<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/17
 * Time: 16:54
 */
try {

    $soap = new SoapClient(null, array(

        "location" => "http://localhost/php/soap/Service1.php?wsdl",

        "uri" => "abcd", //资源描述符服务器和客户端必须对应

        "style" => SOAP_RPC,

        "use" => SOAP_ENCODED

    ));

    echo $soap->Add(12, 2);

} catch (Exction $e) {

    echo print_r($e->getMessage(), true);

}