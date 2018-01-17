<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/17
 * Time: 22:49
 */
$keyword = 'cxtq白云区';
preg_match("/^([a-z]{4})([\x{4e00}-\x{9fa5}]+)/ui",$keyword,$r);
echo "<pre>";
print_r($r);
echo "</pre>";