<?php
/**
 * Created by PhpStorm.
 * User: 村上岗
 * Date: 2016/4/10
 * Time: 18:32
 */
$d = '1208.png';
trim($d);
$str = explode('.',$d);
var_dump($str);
    if($str[1] == 'png') {
        echo 'png';

}