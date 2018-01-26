<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/26
 * Time: 17:27
 */
$str = file_get_contents("../data/undercover.txt");
//echo $str;
$regex = "/(.*?)/";
preg_match_all($regex,$str,$r);
echo "<pre>";
print_r($r);
echo "</pre>";