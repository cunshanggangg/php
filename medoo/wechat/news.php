<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/15
 * Time: 9:36
 */
require_once '../class/database.php';
//$database = new medoo();

$result = $database->select("news","*",["LIMIT"=>10]);
echo "<pre>";
print_r($result);
echo "</pre>";
