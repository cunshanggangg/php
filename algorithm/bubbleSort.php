<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/17
 * Time: 9:18
 */
/* 冒泡排序
   重复地走访过要排序的数列，一次比较两个元素，如果他们的顺序错误就把他们交换过来。
 * */
function bubbleSort($arr)
{
    $len = count($arr);

    for($i = 1; $i < $len; $i++) {
        for($k = 0; $k < $len - $i; $k++) {
            if($arr[$k] > $arr[$k + 1]) {
                $tmp = $arr[$k + 1];
                $arr[$k + 1] = $arr[$k];
                $arr[$k] = $tmp;
            }
        }
    }

    return $arr;
}

$arr = array(5,2,8,12,7,3,10);
$r = bubbleSort($arr);
echo "<pre>";
print_r($r);
echo "</pre>";