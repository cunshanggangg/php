<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/18
 * Time: 16:41
 */
require_once 'conn/conn.php';
/*
MYSQL 事务处理主要有两种方法：
1、用 BEGIN, ROLLBACK, COMMIT来实现
BEGIN 开始一个事务
ROLLBACK 事务回滚
COMMIT 事务确认

2、直接用 SET 来改变 MySQL 的自动提交模式:
SET AUTOCOMMIT=0 禁止自动提交
SET AUTOCOMMIT=1 开启自动提交
*/
//开始定义事务
mysqli_begin_transaction($conn);
if(!mysqli_query($conn,"insert into `tp_student` (name,age,sex) VALUES('丁俊晖',25,1)")) {
    mysqli_query($conn,"ROLLBACK");
}

mysqli_commit($conn);
mysqli_close($conn);
