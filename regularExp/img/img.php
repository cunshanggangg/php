<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 2018/8/8
 * Time: 18:49
 */
$str = '<p><img src="//qimg.mama.cn/content/article/2018/08/0f1489e335b42cbf398afc61d84b0e.jpg" title="decoration.jpg" alt="decoration.jpg"/><img src="//qimg.mama.cn/content/article/2018/08/0f1489e335b42cbf398afc61d84b05656.jpg" title="decoration.jpg" alt="decoration.jpg"/>王治郅内容</p>';
$preg = '/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i';

preg_match_all($preg,$str,$match);
echo "<pre>";
print_r($match);
echo "</pre>";