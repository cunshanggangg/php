<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/23
 * Time: 14:04
 */

$batchDate[] = "SUBSTRING(batch_no,1,6)";
$todayDate[] = date('ymd');

$con = array_combine($batchDate,$todayDate);

echo "<pre>";
print_r($con);
echo "</pre>";
