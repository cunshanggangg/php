<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/16
 * Time: 15:41
 */
$str = "cxwz肯德基";
preg_match("/^(cxwz)([\x{4e00}-\x{9fa5}]+)/ui",$str,$r);
echo "<pre>";
print_r($r);
echo "</pre>";
