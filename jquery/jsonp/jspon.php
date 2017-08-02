<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/1
 * Time: 15:16
 */
//error_reporting(0);
//header("content-type: text/javascript");

if(isset($_GET['name']) && isset($_GET['callback'])) {
    $obj->name = $_GET['name'];
    $obj->message = "Hello " . $obj->name;

    echo $_GET['callback']. '(' . json_encode($obj) . ');';
//    echo 12345;
}

////服务端返回JSON数据
//$arr=array('a'=>1,'b'=>2,'c'=>3,'d'=>4,'e'=>5);
//$result=json_encode($arr);
////echo $_GET['callback'].'("Hello,World!")';
////echo $_GET['callback']."($result)";
////动态执行回调函数
//$callback=$_GET['callback'];
//echo $callback."($result)";