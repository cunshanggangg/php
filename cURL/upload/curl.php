<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/7
 * Time: 11:05
 */
//


$ch =curl_init();

$file = realpath('temp.jpg'); //要上传的文件
//也可以加绝对路径：D:\www\htdocs\php\cURL\upload\temp.jpg'
$fields['file'] = '@'.$file; // 前面加@符表示上传图片
curl_setopt($ch,CURLOPT_URL,'http://localhost/php/cURL/upload/upload.php');
curl_setopt($ch,CURLOPT_POST,true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

//$data = array('name'=>'Foo','file'=>'D:\www\htdocs\php\cURL\upload\temp.jpg');
//
//curl_setopt($ch,CURLOPT_URL,'http://localhost/php/cURL/upload/upload.php');
//curl_setopt($ch,CURLOPT_POST,1);
//curl_setopt($ch,CURLOPT_POSTFIELDS,$data);



$content = curl_exec($ch);
//$result = curl_getinfo($ch);
echo "<pre>";
print_r($content);
//print_r($result);
echo "</pre>";