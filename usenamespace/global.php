<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/19
 * Time: 14:52
 */
include_once 'class/Person.class.php';
$person = new \people\Person();

/* global的声明与赋值要分开来：global $v = "value";(×)
 * 正确的：
 * global $v;
 * $v = "value";
 *
 * 在 PHP 的程序执行时，系统会在内存中保留一块全局变量的区域。
 * 实际运用时，可以透过  $GLOBALS["变量名称"]  将需要的变量取出。
 * 在用户自定的函数或程序中，就可以用  $GLOBALS  数组取出需要的变量”
 * */
echo "<pre>";
print_r($GLOBALS['person']->yaoMing());
echo "</pre>";