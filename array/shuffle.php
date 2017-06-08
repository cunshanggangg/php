<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/8
 * Time: 10:30
 */
//将数组打乱输出
$arr = [
    "name" => "yaoMing",
    "sex" => "male",
    "position" => "center",
    "height" => "2.26m"
];

shuffle($arr);
//echo "<pre>";
//print_r($arr);
foreach ($arr as $key => $value) {
    echo $value;
    echo "<hr>";
}