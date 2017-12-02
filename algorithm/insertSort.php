<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/17
 * Time: 9:33
 */
/* 插入排序
 * 对于每个未排序数据，在已排序序列中从后向前扫描，找到相应位置并插入。
 * 类似 玩扑克牌时自己对扑克牌进行重新排序
 * */
function insertSort($arr)
{
    $len = count($arr);

    for ($i = 1; $i < $len; $i++) {
        $tmp = $arr[$i];
        for ($j = $i - 1; $j >= 0; $j--) {
            if ($tmp < $arr[$j]) {
                $arr[$j + 1] = $arr[$j];
                $arr[$j] = $tmp;
            } else {
                break;
            }
        }
    }

    return $arr;
}
$arr = array(5,2,8,12,7,3,10);
$r = insertSort($arr);
echo "<pre>";
print_r($r);
echo "</pre>";