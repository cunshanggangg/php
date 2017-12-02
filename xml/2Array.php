<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/24
 * Time: 11:08
 */
function XML2Array ( $xml )
{
    $array = simplexml_load_string ( $xml );
    $newArray = array() ;
    //直接将对象转换成数组
    $array = (array)$array ;
//    echo "<pre>";
//    print_r($array);
//    echo "</pre>";exit;
    foreach ( $array as $key => $value )
    {
        //直接将字符串转换成数组
        $value = ( array ) $value ;
//        echo "<pre>";
//        print_r($value);
//        echo "</pre>";
        $newArray [ $key] = $value [ 0 ] ;
    }
    //使用array_map()函数和trim()函数去除左右两边的空格
    $newArray = array_map("trim", $newArray);
    return $newArray ;
}

$xmlStr = <<<xml
<people>
    <name>村上岗</name>
    <gender>男</gender>
    <age>24</age>
    <address>中国 北京</address>
</people>
xml;

//$xml = simplexml_load_string($xmlStr);
$r = XML2Array($xmlStr);
echo "<pre>";
print_r($r);
echo "</pre>";
