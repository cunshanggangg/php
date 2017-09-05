<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/5
 * Time: 14:48
 */
//过滤网页上所有的JS/VBS脚本
//即：把script 标签及其内容去掉

$str="以下内容不显示<script language='javascript'>alert('cc');</script>";
/*
$reg = "/<script[^>].*?>.*?</script>/si";//报错
//Warning: preg_replace(): Unknown modifier 'c' in D:\www\htdocs\php\regularExp\wipeScript\script.php on line 13
*/
$reg = "'<script[^>].*?>.*?</script>'/si";
$res = preg_replace($reg,"替换内容",$str);
echo "<pre>";
print_r($res);
echo "</pre>";

//正确的
//$script="以下内容不显示<script language='javascript'>alert('cc');</script>";
/*
//echo preg_replace("'<script[^>].*?>.*?</script>'si","替换内容",$script);
*/
?>