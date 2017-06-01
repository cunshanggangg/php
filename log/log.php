<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/17
 * Time: 17:01
 */
include('class/Log.class.php');
$msg = "你好！姚明";
$log = new Logs();
$log->setLog($msg);
//echo ($log->Log('',$msg));