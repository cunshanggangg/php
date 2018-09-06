<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 2018/8/28
 * Time: 16:59
 */
$str = '//www.gzmama.com/thread-51764678-1-1.html';
preg_match_all('/\d{7,}/', $str, $match);
echo "<pre>";
print_r($match);
echo "</pre>";