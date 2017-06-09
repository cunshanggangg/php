<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/9
 * Time: 10:05
 */
//去除重复的数组的元素
$arr = [
    "0" => "姚明",
    "1" => "孙悦",
    "2" => "孙杨",
    "3" => "姚明"
];

echo "<pre>";
print_r(array_unique($arr));