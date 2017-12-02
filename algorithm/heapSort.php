<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/17
 * Time: 10:15
 */
/* 堆排序(利用二叉树)
 * 堆排序在 top K 问题中使用比较频繁。堆排序是采用二叉堆的数据结构来实现的，虽然实质上还是一维数组。
 * 二叉堆是一个近似完全二叉树 。

二叉堆具有以下性质：

父节点的键值总是大于或等于（小于或等于）任何一个子节点的键值。
每个节点的左右子树都是一个二叉堆（都是最大堆或最小堆）。
步骤：

构造最大堆（Build_Max_Heap）：若数组下标范围为0~n，考虑到单独一个元素是大根堆，
则从下标n/2开始的元素均为大根堆。于是只要从n/2-1开始，向前依次构造大根堆，
这样就能保证，构造到某个节点时，它的左右子树都已经是大根堆。

堆排序（HeapSort）：由于堆是用数组模拟的。得到一个大根堆后，数组内部并不是有序的。
因此需要将堆化数组有序化。思想是移除根节点，并做最大堆调整的递归运算。
第一次将heap[0]与heap[n-1]交换，再对heap[0...n-2]做最大堆调整。第二次将heap[0]与heap[n-2]交换，
再对heap[0...n-3]做最大堆调整。重复该操作直至heap[0]和heap[1]交换。
由于每次都是将最大的数并入到后面的有序区间，故操作完后整个数组就是有序的了。

最大堆调整（Max_Heapify）：该方法是提供给上述两个过程调用的。
目的是将堆的末端子节点作调整，使得子节点永远小于父节点 。

**/

function heap_sort(array $lists)
{
    $n = count($lists);
    build_heap($lists);
    while (--$n) {
        $val = $lists[0];
        $lists[0] = $lists[$n];
        $lists[$n] = $val;
        heap_adjust($lists, 0, $n);
        //echo "sort: " . $n . "\t" . implode(', ', $lists) . PHP_EOL;
    }
    return $lists;
}

function build_heap(array &$lists)
{
    $n = count($lists) - 1;
    for ($i = floor(($n - 1) / 2); $i >= 0; $i--) {
        heap_adjust($lists, $i, $n + 1);
        //echo "build: " . $i . "\t" . implode(', ', $lists) . PHP_EOL;
    }
    //echo "build ok: " . implode(', ', $lists) . PHP_EOL;
}

function heap_adjust(array &$lists, $i, $num)
{
    if ($i > $num / 2) {
        return;
    }
    $key = $i;
    $leftChild = $i * 2 + 1;
    $rightChild = $i * 2 + 2;

    if ($leftChild < $num && $lists[$leftChild] > $lists[$key]) {
        $key = $leftChild;
    }
    if ($rightChild < $num && $lists[$rightChild] > $lists[$key]) {
        $key = $rightChild;
    }
    if ($key != $i) {
        $val = $lists[$i];
        $lists[$i] = $lists[$key];
        $lists[$key] = $val;
        heap_adjust($lists, $key, $num);
    }
}
$arr = array(2,5,1,9,7,6,4,10,3);
$r = heap_sort($arr);
echo "<pre>";
print_r($r);
echo "</pre>";