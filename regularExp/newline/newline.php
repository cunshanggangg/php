<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/15
 * Time: 15:04
 */
//$str = file_get_contents("user_id.txt");
//$str = file_get_contents("order_sn.txt");
$str = file_get_contents("o_company_order_id2.txt");
$reg = "/(.*?)\r\n/";
$result = preg_match_all($reg,$str,$match);
//echo "<pre>";
////echo $str;
//print_r($match[0]);
//echo "</pre>";

foreach($match[0] as $k => $v) {

    $r = trim($v);
    echo "'".$r."'".',';
}