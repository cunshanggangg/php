<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/1
 * Time: 14:49
 */
//header("Content-type:application/msword");
//$fp=fopen("test.doc","r");
//$file=file($fp);
//
//foreach($file as $k=>$v){
//    echo $v;
//}

$word = new COM("word.application") or die ("Could not initialise MS Word object.");
$word->Documents->Open(realpath("test.docx"));

// Extract content.
//$content = (string) $word->ActiveDocument->Content;
//echo $content;
$content = (string)$word->ActiveDocument->Content;
//$res = explode(" ",$content);
//echo $content;
$res = stripslashes($content);
echo $res;
//echo "<pre>";
//print_r($res);
//echo "</pre>";



$word->ActiveDocument->Close(false);

$word->Quit();
$word = null;
unset($word);

$str = "Name Sex Year Career  yaoMing Male 35 basketball  这是姚明的个人信息。 标题";
