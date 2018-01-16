<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/15
 * Time: 9:36
 */
require_once '../class/database.php';
//$database = new medoo();

//$result = $database->select("news","*",["LIMIT"=>10]);
//echo "<pre>";
//print_r($result);
//echo "</pre>";
$FromUsername = 'csg';
$r = $GLOBALS['database']->select("members","*",['wxname'=>$FromUsername]);
echo "<pre>";
print_r($r);
echo "</pre>";exit;
$time = time();
if($r) {
    $longitude = '111';
    $latitude = '222';
    $GLOBALS['database']->update("members",['longitude'=>$longitude,'latitude'=>$latitude,'join_time'=>$time],['wxname'=>$FromUsername]);
}else{
    $longitude = '333';
    $latitude = '444';
    $GLOBALS['database']->insert("members",['wxname'=>$FromUsername,'longitude'=>$longitude,'latitude'=>$latitude,'join_time'=>$time]);
}
