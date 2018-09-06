<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 2018/8/28
 * Time: 10:34
 */
$arr = [
    0 => 1,
    1 => 2,
    2 => 3,
    3 => 4,
    4 => 5,
    5 => 1,
];

arsort($arr);

//echo "<pre>";
//print_r($arr);
//echo "</pre>"
$stage = "";
foreach ($arr as $value)
{
    $stage .= $value . ',';
}

echo $stage;