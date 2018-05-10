<?php
/**
 * Created by PhpStorm.
 * User: linjiabei
 * Date: 2018/5/10
 * Time: 18:28
 */
$m = new Memcache;

//echo "<pre>";
//print_r($m);
//echo  "</pre>";

$m->connect("localhost",12111);
//echo $m->get("key1");
//保存一个字符串
$m->set('key2','yaoming');
$val = $m->get('key2');
echo $val;
echo "<hr>";
$arr = array("yaoming","lina","langping");
$m->set('key3',$arr);
$val1 = $m->get('key3');
echo "<pre>";
print_r($val1);
echo "</pre>";
