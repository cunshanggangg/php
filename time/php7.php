<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/24
 * Time: 23:50
 */
//php7中？？与？：的区别
$b = 1;
$c = '';
//$a = $c ?? $b;
$a = $c ? $c : $b;
echo $a;