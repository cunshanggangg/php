<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/29
 * Time: 15:19
 */
//设定时区
date_default_timezone_set("PRC");
//以时间为文件名
$fileName = date("Y-m-d-H-i-s",time());
//echo $fileName;

//注：这里的mysql数据库的密码一定不能为空，否则，不能使用mysqldump命令。
$command = "D:\www\mysql\bin\mysqldump -h192.168.17.39 -uroot -p123456 test csg_student>E:\\temp\\{$fileName}.sql";
//加一个"\"效果一样
//$command = "D:\\www\\mysql\\bin\\mysqldump -h192.168.17.39 -uroot -p123456 test csg_student>E:\\temp\\{$fileName}.sql";

//echo $command;
//exit;
exec($command);