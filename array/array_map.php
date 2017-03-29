<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/29
 * Time: 15:19
 */
//将回调函数作用到给定数组的单元上
function cube($n) {
    return $n*$n*$n;
}

$arr = array("1","2","3","4");
echo "<pre>";
print_r(array_map("cube",$arr));//1,8,27,64
echo "</pre>";