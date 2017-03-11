<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/24
 * Time: 17:09
 */
$array = array();
array_push($array,1);
array_push($array,array(1,2,3));
echo '<pre>';
print_r($array);
array_push($array[1],array(1,2,3));
print_r($array);//