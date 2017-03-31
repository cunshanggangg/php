<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/31
 * Time: 15:53
 */
//1.直接输出
//include "class/phpqrcode.php";
//$value="cunshanggang";
//$errorCorrectionLevel = "L";//纠错级别：L、M、Q、H
//$matrixPointSize = "4";//点的大小：1到10
//QRcode::png($value, false, $errorCorrectionLevel, $matrixPointSize);

//2.以图片下载的形式
//include "class/phpqrcode.php";
//$data = 'http://www.useryx.com';
//$filename = 'useryx.png';//生成的文件名
//$errorCorrectionLevel = 'L';//纠错级别：L、M、Q、H
//$matrixPointSize = 4;//点的大小：1到10
//QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);

//3.生成中间带logo的二维码
include "class/phpqrcode.php";
$value='cunshanggang';
$logo = 'logo.jpg';//中间的logo
$QR = "base.png";//自定义生成的,结束后可以删除
$last = "last.png";//最终生成的图片
$errorCorrectionLevel = 'L';
$matrixPointSize = 10;
QRcode::png($value, $QR, $errorCorrectionLevel, $matrixPointSize, 2);
if($logo !== FALSE){
    $QR = imagecreatefromstring(file_get_contents($QR));
    $logo = imagecreatefromstring(file_get_contents($logo));
    $QR_width = imagesx($QR);
    $QR_height = imagesy($QR);
    $logo_width = imagesx($logo);
    $logo_height = imagesy($logo);
    $logo_qr_width = $QR_width / 5;
    $scale = $logo_width / $logo_qr_width;
    $logo_qr_height = $logo_height / $scale;
    $from_width = ($QR_width - $logo_qr_width) / 2;
    imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
}
imagepng($QR,$last);//生成最终的文件

