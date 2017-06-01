<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/17
 * Time: 17:01
 */
include('class/Log.class.php');
$msg = "你好！王治郅";
$log = new Logs();
$log->setLog($msg);
//$log->LogDebug($msg);