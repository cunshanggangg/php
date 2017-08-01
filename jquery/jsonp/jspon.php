<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/1
 * Time: 15:16
 */
error_reporting(0);
//header("content-type: text/javascript");

if(isset($_GET['name']) && isset($_GET['callback'])) {
    $obj->name = $_GET['name'];
    $obj->message = "Hello " . $obj->name;

    echo $_GET['callback']. '(' . json_encode($obj) . ');';
//    echo 12345;
}