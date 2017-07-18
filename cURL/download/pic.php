<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/18
 * Time: 15:43
 */
function download_img($url = "", $filename = "")
{
    $ch = curl_init(); //初始化一个curl句柄
    $hd = fopen($filename,'wb'); //只写打开或新建一个二进制文件；只允许写数据
    curl_setopt($ch,CURLOPT_URL,$url); //需要获取的 URL 地址
    curl_setopt($ch,CURLOPT_FILE,$hd); //设置成资源流的形式
    curl_setopt($ch,CURLOPT_HEADER,0); //启用时会将头文件的信息作为数据流输出。
    //curl_setopt($ch,CURLOPT_RETURNTRANSFER,false);//以数据流的方式返回数据,false时直接显示
    curl_setopt($ch,CURLOPT_TIMEOUT,60); //设置超时时间
    curl_exec($ch); //执行curl
    $curlinfo = curl_getinfo($ch);
//    echo "string";
    echo "<pre>";
    print_r($curlinfo);
    curl_close($ch); //关闭curl会话
    fclose($hd); //关闭句柄
    return true;
}
download_img('http://www.sd020.com/data/upload/shop/store/goods/1/2015/09/17/1_04958027754911027.jpg','aaa.jpg');