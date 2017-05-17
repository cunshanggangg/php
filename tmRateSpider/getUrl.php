<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/24
 * Time: 17:50
 */
//获取网页地址
//echo $_SERVER['PHP_SELF']."<br>";
$test = parse_url("https://detail.tmall.com/item.htm?spm=a220m.1000858.1000725.6.iyFkiH&id=537536530819&skuId=3209978978898&user_id=1714128138&cat_id=2&is_b=1&rn=8a2d20a9dc86ac9e6e0a1750d941e1e6");
echo "<pre>";
print_r($test);
echo "</pre>";
echo "<hr>";
echo "<pre>";
print_r($test['query']);
echo "</pre>";

//获取参数字符串
$str = $test['query'];
$arr[] = explode('&',$str);
echo "<pre>";
print_r($arr);
echo "</pre>";
echo "<hr>";

preg_match_all('');


