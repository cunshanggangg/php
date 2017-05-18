<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/18
 * Time: 16:37
 */
$conn = mysqli_connect("localhost","root","") or die("MySQL连接失败！");
$db = mysqli_select_db($conn,"tp") or die("数据库连接失败！");
$unicode = mysqli_query($conn,"set names utf8");
//设置为不自动提交，因为MySQL默认立即执行
mysqli_query($conn,"SET AUTOCOMMIT=0");
