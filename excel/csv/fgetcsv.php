<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/30
 * Time: 17:13
 */

//全部变为字符串输出
/*
$row = 1;
if (($handle = fopen("test.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
//        echo "<p> $num fields in line $row: <br /></p>\n";
        echo $num;
        echo "\n";
        $row++;
        for ($c=0; $c < $num; $c++) {
            echo iconv("gb2312","UTF-8",$data[$c]);
            echo "<hr>";
        }
    }
    fclose($handle);
}
*/

//按照数组的形式打印出来
$file = fopen("test.csv","r");

while(! feof($file))
{
    //echo "<pre>";
//    $res = iconv("gb2312","UTF-8",fgetcsv($file));
//    print_r(fgetcsv($file));
//    print_r($res);
    $res = fgetcsv($file);
    foreach((array)$res as $key => $value){
        echo iconv("gb2312","UTF-8",$value);
    }
    //echo "</pre>";
}
fclose($file);

