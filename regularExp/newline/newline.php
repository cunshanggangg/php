<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/15
 * Time: 15:04
 */
$str = file_get_contents("user_id.txt");
$reg = "/(.*?)\r\n/";
$result = preg_match_all($reg,$str,$match);
//echo "<pre>";
////echo $str;
//print_r($match[0]);
//echo "</pre>";

foreach($match[0] as $k => $v) {
    echo $v.',';
}