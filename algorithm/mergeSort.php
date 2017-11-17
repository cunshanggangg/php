<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/17
 * Time: 9:57
 */
/* 归并排序
 * 先递归分解数组，再合并数组
 * */
function mergeSort(array $lists)
{
    $n = count($lists);
    if ($n <= 1) {
        return $lists;
    }
    $left = mergeSort(array_slice($lists, 0, floor($n / 2)));
    $right = mergeSort(array_slice($lists, floor($n / 2)));
    $lists = merge($left, $right);
    return $lists;
}

function merge(array $left, array $right)
{
    $lists = [];
    $i = $j = 0;
    while ($i < count($left) && $j < count($right)) {
        if ($left[$i] < $right[$j]) {
            $lists[] = $left[$i];
            $i++;
        } else {
            $lists[] = $right[$j];
            $j++;
        }
    }
    $lists = array_merge($lists, array_slice($left, $i));
    $lists = array_merge($lists, array_slice($right, $j));
    return $lists;
}
$arr = array(5,2,8,12,7,3,10,11);
$r = mergeSort($arr);
echo "<pre>";
print_r($r);
echo "</pre>";
