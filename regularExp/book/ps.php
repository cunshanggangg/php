<?php
/**
 * Created by PhpStorm.
 * User: linjiabei
 * Date: 2018/6/22
 * Time: 18:14
 */
$s = "中国p：各位亲爱的书迷，现在可以添加花刺的公众微信，微信上搜索“花刺1913”添加关注即可！里边不禁有小说的最新免费连载，还有各种福利，美女主角图片等等！而且最重要的是，花刺会每个礼拜在里边发大红包！先到先抢……看运气哦！快快关注我吧！！";
$k = "p";
//$s = '可以删除指定字符前面的所有字符串';
//$k = '面';
//echo strstr($s, $k);//面的所有字符串
echo "<hr>";
//echo strtok($s, $k); //可以删除指定字符前
echo mb_substr($s,0,mb_strpos($s,$k,0,'utf-8'),'utf-8');  //utf-8编码