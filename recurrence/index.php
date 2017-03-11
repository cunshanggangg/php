<?php
/**
 * Created by PhpStorm.
 * User: 村上岗
 * Date: 2016/4/10
 * Time: 15:44
 */
error_reporting(0);
function showdir($path){
    $dh = opendir($path);//打开目录

    while(($d = readdir($dh)) != false) {  //逐个文件读取，添加!=false条件，是为避免有文件或目录的名称为0
        if($d=='.' || $d == '..') { //判断是否为.或..，默认都会有
            continue;
        }

        trim($d);//除去左右的空格
        $str = explode('.',$d);
            if($str[1] == 'png' && !is_dir($path.'/'.$d)) {//利用切割判断后缀名是否为png,即是否为图片格式
                $imgPath = $path.'/'.$d;
                echo "<img src={$imgPath}>";
                echo '<br>';
            }
        if(is_dir($path.'/'.$d)) {//如果为目录
            showdir($path.'/'.$d); //继续读取该目录下的目录或文件
        }
    }
}

$path = './';//当前目录

showdir($path);




