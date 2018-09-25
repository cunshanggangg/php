<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 2018/9/11
 * Time: 12:15
 */
//if(3) {
//    echo 'yaoMing';
//}

//$pinyin = 'guangzhou';
//$view = 'article';
//$tid = '54321';
//echo genArticleUrl($pinyin, $view, $tid);
//function genArticleUrl($pinyin, $view, $tid)
//{
//    return 'http://m.mama.cn/city/' . $pinyin . '/' . $view . '-' . $tid;
//}

$arr = [
  1 => '11',
  2 => '22',
  3 => '33',
  4 => '44',
  5 => '55',
  6 => '66'
];
//echo "<pre>";
//print_r($arr);exit;
$str = '1,3';
$patterns[0] = "/1/";
$patterns[1] = "/2/";
$patterns[2] = "/3/";


$res = preg_replace($patterns, $arr, $str);//11,33
echo "<pre>";
print_r($res);
echo "</pre>";exit;