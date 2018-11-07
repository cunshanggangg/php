<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 2018/10/11
 * Time: 14:13
 */

$str = 'https://qimg.mama.cn/home/diary/2018/10/37b1ce4ce0ce260befc0ddfb052f31_w300X208_w196X135.jpg';

$result = str_replace('https://qimg.mama.cn/home/','', $str);
echo "<pre>";
print_r($result);