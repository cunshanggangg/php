<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/7
 * Time: 11:04
 */
//print_r($_POST);
print_r($_FILES);
//echo "46545";

$uploaddir = 'D:/www/htdocs/php/cURL/upload/data/';
$uploadfile = $uploaddir . basename($_FILES['file']['name']);

echo '<pre>';
if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
    echo "File is valid, and was successfully uploaded.\n";//成功上传，并保存到相应的文件夹
} else {
    echo "Possible file upload attack!\n";//上传失败
}

echo 'Here is some more debugging info:';