<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/21
 * Time: 16:52
 */
if($_REQUEST['act'] == "getInfo"){
////    echo "yaoMing";
    $re['userName'] = $_GET['username'];
    $re['password'] = $_GET['password'];

    jsonStr($re);
//    echo json_encode($re);
//    echo "<pre>";
//    print_r(json_encode($re));
//    echo "</pre>";
    //exit(json_encode($re));
}

function jsonStr($data) {
//    return json_encode($data);
    exit(json_encode($data));
}