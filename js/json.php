<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 2018/8/4
 * Time: 11:16
 */
$stage = ['1','2'];
$desc = ['测试1','测试2'];
$content = ['<p>姚明</p>','<p>大叫大大大大大</p>'];

echo "<pre>";
print_r(json_encode($stage,JSON_UNESCAPED_UNICODE));
echo "<hr>";
print_r(json_encode($desc,JSON_UNESCAPED_UNICODE));
echo "<hr>";
print_r(json_encode($content,JSON_UNESCAPED_UNICODE));
echo "</pre>";
