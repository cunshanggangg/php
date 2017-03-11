<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/23
 * Time: 14:30
 */
$arr = array("yaoMing","langPing","liNa","sunYang");

$rep = array("yiJianLian","gaoLin");

//$out = array_splice($arr,1,count($arr),$rep);

//$out = array_splice($arr,-1,1,$rep);
//$out = array_splice($arr,1,-1,$rep);
$out = array_splice($arr,3,1,$rep);
echo "<pre>";
print_r($out);
echo "</pre>";

echo "<hr>";
echo "<pre>";
print_r($arr);
echo "</pre>";
echo "<hr>";
$input  = array("red","green","blue","yellow");
array_splice ( $input,-1,3,array("black","maroon"));
echo "<pre>";
print_r($input);
echo "</pre>";
