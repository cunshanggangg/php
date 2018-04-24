<?php
/**
 * Created by PhpStorm.
 * User: linjiabei
 * Date: 2018/4/24
 * Time: 16:48
 */
$str = '2018-03-27 下午 06:43:07';
if(strpos($str,'xp')===false){
    echo '不存在！';
}else{
    echo '存在！';
}

if(strstr($str,'下午')){
    echo "yes";
}else{
    echo "no";
}