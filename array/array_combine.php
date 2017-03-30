<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/30
 * Time: 15:08
 */
//创建一个数组，用一个数组的值作为其键名，另一个数组的值作为其值

$arr = array('a','b','c','d','e');
$arr1 = array('aaa','bbb','ccc','ddd','eee');
//注意：如果键值数跟值的个数不一样，会直接报错
$res = array_combine($arr1,$arr);
echo "<pre>";
print_r($res);
echo "</pre>";