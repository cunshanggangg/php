<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/2
 * Time: 11:24
 */
$str = 'abcdfghijk';
$result = mb_substr($str,-2,-3,'utf-8');
// Q：start起始值为负值的时候，无法进行倒数进行切割。
// 譬如：(-1,-2)，目的是切割最后两个字符但无法获得结果。
echo "<pre>";
print_r($result);