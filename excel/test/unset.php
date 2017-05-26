<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/26
 * Time: 10:49
 */
$arr = array(
    array("0" => "yaoMing","1" => "liuXiang","2" => "sunYang", "3" => ""),
    array("0" => "liNa","1" => "dingNing","2" => "fuYuanHui","3" => "")
);

foreach($arr as $key1=>$v) {
    foreach($v as $key2=>$v2) {
        if(!$v2) {
            unset($arr[$key1][$key2]);
        }
//        array_filter($arr[$key1]);
    }
//   $res[] =  array_filter($v);
}
echo "<pre>";
print_r($arr);
echo "</pre>";