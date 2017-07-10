<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/7
 * Time: 14:48
 */
$ch=curl_init();
//$url="http://localhost/php/cURL/download/data/test.txt";
$url = "http://192.168.17.39/csg/test.txt";//测试 success
  curl_setopt($ch,CURLOPT_URL, $url);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
  $content=curl_exec($ch);
  if(curl_errno($ch)){
      echo curl_error($ch);
      curl_close($ch);
  }else{
      curl_close($ch);
      //提取文件名和文件类型
      $nameArr=explode('/',$url);
  $last_index=count($nameArr)-1;
  $file_name=$nameArr[$last_index];
  $typeArr=explode('.',$url);
  $last_index=count($typeArr)-1;
  $file_type=$typeArr[$last_index];
  //获得文件大小
  $file_size=strlen($content);
  //通知浏览器下载文件
  header("Content-type: application/$file_type");
  header('Content-Disposition: attachment; filename="'.$file_name.'"');
  header("Content-Length:".$file_size);
  exit($content); //输出数据流
  }