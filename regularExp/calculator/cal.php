<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/29
 * Time: 11:06
 */

$str = '26+9';
$preg = "/(\d+)([+-])(\d+)/i";
preg_match_all($preg,$str,$match);
echo "<pre>";
print_r($match);
echo "</pre>";