<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/27
 * Time: 17:36
 */
$str = file_get_contents('data/sql.txt');
//echo $str;

preg_match_all("/(?!COMMENT)'[^\r\n]+',/",$str,$result);
echo "<pre>";
print_r($result[0][0]);
echo "</pre>";