<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/24
 * Time: 13:35
 */
$conn = mysql_connect("localhost","root","") or die("MySQL连接失败!");
$db = mysql_select_db("tp",$conn) or die("数据库连接失败!");
$code = mysql_query("set names utf8");