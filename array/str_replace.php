<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/23
 * Time: 16:24
 */
/* str_replace()子字符串替换
 * 该函数返回一个字符串或者数组。
 * 该字符串或数组是将 subject 中全部的 search 都被 replace 替换之后的结果。
 * */
$_GET['tp'] = 'a';
$card = str_replace(array('a','b','c','d'),range(1,4),$_GET['tp']);
echo "<pre>";
print_r($card);
echo "</pre>";
echo "<hr>";

/*
 * range — 建立一个包含指定范围单元的数组
 * */
echo "<pre>";
print_r(range(1,4));
echo "</pre>";