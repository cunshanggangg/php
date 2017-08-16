<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/15
 * Time: 15:04
 */
//$str = file_get_contents("user_id.txt");
//$str = file_get_contents("order_sn.txt");
//$str = file_get_contents("o_company_order_id2.txt");
//$str = file_get_contents("el_order_id.txt");
$str = file_get_contents("o_company_order_id.txt");
$reg = "/(.*?)\s/";
$result = preg_match_all($reg,$str,$match);
echo "<pre>";
////echo $str;
print_r($match);
echo "</pre>";
//echo "46546";
foreach($match[0] as $k => $v) {

    $r = trim($v);
//    echo "'".$r."'".',';
    echo $r.',';
}