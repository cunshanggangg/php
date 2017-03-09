<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 17-3-9
 * Time: 下午5:17
 */

$conn = mysql_connect("localhost","root","123456") or die("mysql连接错误");
$db = mysql_select_db("mysql",$conn) or die("数据库连接失败！");
$code = mysql_query("set names utf8");