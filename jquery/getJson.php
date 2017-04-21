<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/21
 * Time: 16:52
 */
if($_REQUEST['act'] == "getInfo"){
//    echo "yaoMing";
    $re['userName'] = $_GET['userName'];
    $re['password'] = $_GET['password'];

    echo "dddddddddd";
    return json_encode($re);
}