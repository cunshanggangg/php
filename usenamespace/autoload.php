<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/18
 * Time: 11:41
 */
function __autoload($class) {
    $file = 'class/'.$class.".class.php";
    //echo is_file($file);
    if(is_file($file)) {
        require_once($file);
    }
}

$obj = new Person();
$obj->yaoMing();