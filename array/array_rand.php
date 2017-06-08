<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/8
 * Time: 11:02
 */
$arr = [
    "yaoMing" => [
        "sex" => "male",
        "height" => "2.26m",
        "birthday" => "1980-09-12",
        "position" => "center"
    ],

    "liuXiang" => [
        "sex" => "male",
        "height" => "1.88m",
        "birthday" => "1983-07-13",
        "position" => "hurdles"
    ]
];

echo "<pre>";
//print_r($arr);
//返回一个数组的键值
print_r(array_rand($arr,2));
