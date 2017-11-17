<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/17
 * Time: 9:42
 */
/*
 * 快速排序
 * 从数列中挑出一个元素作为基准数，分区过程，将比基准数大的放到右边
 * 小于或等于它的数都放到左边。在对左右区间递归执行第二步，直至各区间
 * 只有一个数。
*/
function quickSort($arr) {
    // 先设定结束条件，判断是否需要继续进行
    if(count($arr) <= 1) {
        return $arr;
    }

    // 选择第一个元素作为基准元素
    $base_value = $arr[0];

    // 初始化小于基准元素的左数组
    $left_array = array();

    // 初始化大于基准元素的右数组
    $right_array = array();

    // 遍历除基准元素外的所有元素，按照大小关系放入左右数组内
    array_shift($arr);
    foreach ($arr as $value) {
        if ($value < $base_value) {
            $left_array[] = $value;
        } else {
            $right_array[] = $value;
        }
    }

    // 再分别对左右数组进行相同的排序
    $left_array = quickSort($left_array);
    $right_array = quickSort($right_array);

    // 合并基准元素和左右数组
    return array_merge($left_array, array($base_value), $right_array);
}
$arr = array(5,2,8,12,7,3,10,1);
$r = quickSort($arr);
echo "<pre>";
print_r($r);
echo "</pre>";