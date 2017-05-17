<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/17
 * Time: 16:54
 */
class Service

{

    public function HelloWorld()

    {

        return "Hello";

    }

    public function Add($a,$b)

    {

        return $a+$b;

    }

}

$server=new SoapServer(null,array('uri' => "abcd"));

$server->setClass("Service");

$server->handle();