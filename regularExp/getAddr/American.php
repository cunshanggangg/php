<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/25
 * Time: 15:40
 */

//$str = file_get_contents("http://www.fakeaddressgenerator.com/World_more/china_address_generator");
$str = file_get_contents("data/american_html.txt");
//echo $str;
$preg = "/value='(.*?)'/";//可以使用
//$preg = "|value='(.*)'|isU";//可以使用
preg_match_all($preg,$str,$match);
echo "<pre>";
print_r($match);
echo "</pre>";