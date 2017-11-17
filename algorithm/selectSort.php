<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/17
 * Time: 9:26
 */
/* 选择排序
 * 在未排序序列中找到最小(大)元素，存放到排序序列的起始位置，再从剩余未排序元素中
 * 继续寻找最小(大)元素，然后放到已排序序列的末尾。
 * */
function selectSort($arr)
{
    $len = count($arr);

    for ($i = 0; $i < $len; $i++) {
        $p = $i;

        for ($j = $i + 1; $j < $len; $j++) {
            if ($arr[$p] > $arr[$j]) {
                $p = $j;
            }
        }

        $tmp = $arr[$p];
        $arr[$p] = $arr[$i];
        $arr[$i] = $tmp;
    }

    return $arr;
}
$arr = array(5,2,8,12,7,3,10);
$r = selectSort($arr);
echo "<pre>";
print_r($r);
echo "</pre>";